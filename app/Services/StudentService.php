<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

use App\Activity;
use App\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentService implements IStudentService
{
    public function land($user) {
        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $coursesIds = $user->grade->courses->pluck('id')->all();

        $activities = Activity::query()
            ->with('Course')
            ->whereBetween('due_date', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereIn('course_id', $coursesIds)
            ->orderBy('due_date', 'asc')
            ->get();

        $today = $activities->filter(function ($item) {
            return $item->due_date->isToday();
        })->first();



        $dones = null;
        if($today != null) {
            $query = "SELECT
            (select count(1) from users where grade_id = ? and is_student = 1) as total,
            (select count(1) from user_activities where activity_id = ? and deleted_at is null) as hechas,
            (select count(1) from user_activities where activity_id = ? and deleted_at is null and user_id = ?) > 0 as hecha_por_mi";

            $dones = DB::select($query, [$today->course->grade_id, $today->id, $today->id, $user->id]);
            $dones = $dones[0];

            $activities = $activities->filter( function ($item) use($today) {
                return $item->id != $today->id;
            });

            if($dones->hecha_por_mi) {
                $today = null;
            }
        }

        $news = News::where('grade_id', $user->grade_id)
            ->where('published', '<=', Carbon::now())
            ->orderBy('published', 'desc')
            ->take(5)
            ->get();


        return compact('activities', 'today', 'dones', 'news');
    }
}
