<?php

namespace App\Repositories;

use App\Activity;
use App\UserActivity;
use App\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;


class ActivityRepository implements IActivityRepository
{

    public function forTheUser(Activity $activity, User $user): bool {
        $cant = $user->grade->courses()->where('id', $activity->course_id)->count();

        return $cant != 0;
    }


    public function register(Activity $activity, User $user) : UserActivity {

        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();

        $entity = UserActivity::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id
        ]);

        return $entity;
    }

    public function unregister(Activity $activity, User $user) : void {

        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();
    }

    public function calcGradeStatusOf(Activity $today, User $user): object {
        $query = "SELECT
                (select count(1) from users where grade_id = ? and is_student = 1) as total,
                (select count(1) from user_activities where activity_id = ? and deleted_at is null) as hechas,
                (select count(1) from user_activities where activity_id = ? and deleted_at is null and user_id = ?) > 0 as hecha_por_mi";

        $dones = DB::select($query, [$today->course->grade_id, $today->id, $today->id, $user->id]);
        $dones = $dones[0];

        return $dones;
    }

    public function pendingActivities(User $user) :array {
        $coursesIds = $user->grade->courses->pluck('id')->all();

        $ids = Activity::query()
            ->select('id')
            ->whereBetween('due_date', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereIn('course_id', $coursesIds)
            ->orderBy('course_id', 'asc')
            ->orderBy('due_date', 'asc')
            ->pluck('id')
            ->all();

        $ids_str = implode(",", $ids);

        if(empty($ids)) {
            return [];
        }

        $query = "SELECT * from activities a where a. id not in (
                    select user_activities.activity_id
                    from user_activities
                    where activity_id in ($ids_str)
                    and user_id = ?
                    and deleted_at is null
                )
                AND id in ($ids_str)
                order by a.created_at"; //by course_id asc, due_date asc";

        $dones = DB::select($query, [$user->id] );

        return array_map(function ($item) {
            $activity = new Activity( (array)$item );
            $activity->id = $item->id;

            return  $activity;
        }, $dones);
    }

    public function weekActivities(User $user): Collection {
        $coursesIds = $user->grade->courses->pluck('id')->all();

        $activities = Activity::query()
            // ->select('id')
            ->whereBetween('due_date', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereIn('course_id', $coursesIds)
            ->orderBy('id', 'asc')
            ->get();

        $ids = $activities->pluck('id')->all();
        $ids_str = implode(",", $ids);

        if(empty($ids)) {
            return collect();
        }

        $query = "SELECT user_activities.activity_id as id
                from user_activities
                where activity_id in ($ids_str)
                and user_id = ?
                and deleted_at is null
            ";

        $dones = DB::select($query, [$user->id] );
        $dones = array_map(function ( $item) {
            return $item->id;
        }, $dones);

        $activities->map(function($item) use (&$dones) {
            $item->done = in_array($item->id, $dones);
        });

        return $activities;
    }
}
