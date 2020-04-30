<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

use App\Activity;
use App\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentService implements IStudentService
{

    private function findNextActivity($activities) {
        $today = $activities->filter(function ($item) {
            return $item->due_date->isToday();
        });

        $ids = $today->pluck('id')->all();
        $ids_str = implode(",", $ids);

        $query = "SELECT * from activities a where a. id not in (
                    select user_activities.activity_id
                    from user_activities
                    where activity_id in ($ids_str)
                    and deleted_at is null
                )
                AND id in ($ids_str)
                order by course_id asc, due_date asc
                limit 1";

        $dones = DB::select($query, [$ids_str, $ids_str] );

        if(count($dones) > 0) {
            return new Activity((array)$dones[0]);
        } else {
            return null;
        }
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

        $coursesIds = $user->grade->courses->pluck('id')->all();

        $activities = Activity::query()
            ->with('Course')
            ->whereBetween('due_date', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereIn('course_id', $coursesIds)
            ->orderBy('course_id', 'asc')
            ->orderBy('due_date', 'asc')
            ->get();

        $dones = null;
        $today = $this->findNextActivity($activities);

        if($today != null) {
            $dones = $this->findStatusActivity($today, $user);

            $activities = $activities->filter( function ($item) use($today) {
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
