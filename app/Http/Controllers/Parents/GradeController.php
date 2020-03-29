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
                        a.course_id, c.name, a.due_date, a.scored, ua.id as ua_id, a.id, ua.created_at, c.icon, a.title
                    FROM activities a 
                        JOIN courses c ON a.course_id = c.id
                        LEFT JOIN user_activities ua ON a.id = ua.activity_id
                    WHERE
                        c.grade_id = :grade_id
                        AND ua.deleted_at IS null 
                        AND (ua.user_id = :user OR ua.user_id is null)
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
