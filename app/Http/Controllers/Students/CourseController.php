<?php

namespace App\Http\Controllers\Students;

use App\Course;
use Illuminate\Http\Request;
use App\UserActivity;
use App\Activity;

class CourseController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $user = \Auth::user();

        if($user->grade_id != $course->grade_id) {
            return redirect("/");
        }
        $ids = $course->activities->pluck('id');
        $checked = UserActivity::select('activity_id')
                        ->whereIn('activity_id', $ids)
                        ->where('user_id', $user->id)
                        ->pluck('activity_id');

        return view("course.show", ['course' => $course, 'checked' => $checked]);
    }
}
