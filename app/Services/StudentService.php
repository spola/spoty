<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

use App\Activity;
use App\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentService implements IStudentService
{

    private function pendingActivities($user) {
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
                    and deleted_at is null
                )
                AND id in ($ids_str)
                order by course_id asc, due_date asc";

        $dones = DB::select($query, [$ids_str, $ids_str] );

        return array_map(function ($item) {
            $activity = new Activity( (array)$item );
            $activity->id = $item->id;

            return  $activity;
        }, $dones);
    }

    private function findStatusActivity($today, $user) {
        $query = "SELECT
                (select count(1) from users where grade_id = ? and is_student = 1) as total,
                (select count(1) from user_activities where activity_id = ? and deleted_at is null) as hechas,
                (select count(1) from user_activities where activity_id = ? and deleted_at is null and user_id = ?) > 0 as hecha_por_mi";

        $dones = DB::select($query, [$today->course->grade_id, $today->id, $today->id, $user->id]);
        $dones = $dones[0];

        return $dones;
    }

    public function land($user) {
        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $dones = null;
        $today = null;
        $activities = $this->pendingActivities($user);

        $todayPending = array_filter($activities, function ($item) {
            return $item->due_date->isToday();
        });

        if(!empty($todayPending)) {
            $today = array_shift($todayPending);
            $dones = $this->findStatusActivity($today, $user);

            $activities = array_filter($activities, function ($item) use($today) {
                return $item->id != $today->id;
            });
        }

        $news = News::where('grade_id', $user->grade_id)
            ->where('published', '<=', Carbon::now())
            ->orderBy('published', 'desc')
            ->take(5)
            ->get();


        return compact('activities', 'today', 'dones', 'news');
    }
}
