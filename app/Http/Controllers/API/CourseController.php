<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;
use App\UserActivity;
use Validator;

class CourseController extends ResponseController
{
    public function activities(Request $request, Course $course) {
        $id = $request->user()->id;

        $ids = $course->activities->pluck('id')->all();
        $checked = UserActivity::select('activity_id')
                        ->whereIn('activity_id', $ids)
                        ->where('user_id', $id)
                        ->pluck('activity_id');

        $activities = $course->activities->map(function($activity) use(&$ids) {
            $activity->setHidden(['created_at', 'updated_at', 'deleted_at']);
            $activity->checked = in_array($activity->id, $ids);
            return $activity;
        });


        return $this->sendResponse($course->activities);
    }
}
