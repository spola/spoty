<?php

namespace App\Http\Controllers\Parents;

use App\Grade;
use Illuminate\Http\Request;
use App\UserActivity;
use App\Activity;
use App\Http\Controllers\Controller;


class GradeController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {

        $user = \Auth::user();
        $student = $user->childrens()->where('grade_id', $grade->id)->first();

        /*

        if($user->grade_id != $course->grade_id) {
            return redirect("/");
        }
        */

        $queryStr = "SELECT 
                        a.course_id, c.name, a.due_date, a.scored, a.id, c.icon, a.title,
                        (select ua.id from user_activities ua where ua.activity_id = a.id and ua.user_id = :user and ua.deleted_at is null) as resp_id
                    FROM activities a 
                        JOIN courses c ON a.course_id = c.id
                    WHERE
                        c.grade_id = :grade_id
                    ORDER BY a.course_id, a.published";

        $results = \DB::select( \DB::raw($queryStr), [
            'grade_id' => $grade->id,
            'user' => $student->id,
        ]);


        return view("parents.course.show", [
            'grade'     => $grade,
            'student'   => $student,
            'results'   => $results
        ]);
    }
}
