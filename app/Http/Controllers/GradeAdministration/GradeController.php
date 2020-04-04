<?php

namespace App\Http\Controllers\GradeAdministration;

use Illuminate\Http\Request;
use App\Http\Controllers\GradeAdministration\Controller as BaseController;
use App\Activity;
use App\Grade;

class GradeController extends BaseController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activity(Grade $grade)
    {
        return view('grade_administration.grades.activity', [
            'grade' => $grade,
            'activity_types' => Activity::$TYPES
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Grade $grade, Request $request)
    {
        $request->validate([
            'course' => 'required',
            'title' => 'required|string',
            //'description' => 'required',
            'published' => 'date',
            'due_date' => 'date',
            'link' => 'required|url',
            'type' => 'required',
        ]);

        $data = $request->all();
        $data['course_id'] = $data['course'];
        $data['scored'] = isset($data['scored']) && $data['scored'] == "1";

        $activity = Activity::create($data);

        return redirect()
            ->route('administration.grades.show', ['grade' => $grade])
            ->with("message", 'Actividad registrada');
    }

    public function activityEdit(Grade $grade, Activity $activity) {
        return "hola";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        $courses = $grade->courses()->select('id')->pluck('id')->toArray();

        $activities = Activity::whereIn('course_id', $courses)
            ->orderBy('published', "desc")
            ->withTrashed()
            ->get();

        return view('grade_administration.grades.show', [
            'grade' => $grade,
            'activities' => $activities,
        ]);
    }
}
