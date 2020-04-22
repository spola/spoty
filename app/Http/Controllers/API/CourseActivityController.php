<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;

use App\Course;
use App\Activity;
use App\UserActivity;

use App\Repositories\IActivityRepository;



class CourseActivityController extends ResponseController
{
    /**
     * Repository
     *
     * @var IActivityRepository
     */
    private $repository;

    public function __construct(IActivityRepository $repository) {
        $this->repository = $repository;

        $this->middleware(function ($request, $next) {
            $user = $request->user();
            $course = $request->route('course');

            if($course->grade_id != $user->grade_id) {
                return abort(403, "Course Forbidden");
            }

            $activity = $request->route('activity');
            if( isset($activity) ) {
                //Si no viene activity, entonces no validamos nada más.
                //Acá se valida que la actividad sea del curso y que pertenesca al usuario
                if($activity->course_id != $course->id) {
                    return abort(403, "Activity not found in Course");
                }
                if( !$this->repository->forTheUser($activity, $user)) {
                    return abort(403, "Activity not for the user");
                }
            }

            return $next($request);
        });
    }

    public function index(Request $request, Course $course) {
        $id = $request->user()->id;

        $ids = $course->activities->pluck('id');
        $checked = UserActivity::select('activity_id')
                        ->whereIn('activity_id', $ids)
                        ->where('user_id', $id)
                        ->pluck('activity_id')
                        ->all();

        $activities = $course->activities->map(function($activity) use(&$checked) {
            $activity->setHidden(['created_at', 'updated_at', 'deleted_at']);
            $activity->checked = in_array($activity->id, $checked);
            return $activity;
        });


        return $this->sendResponse($course->activities);
    }

    public function update(Request $request, Course $course, Activity $activity) {
        $user = $request->user();


        if($request->checked) {
            $this->repository->register($activity, $user);
        } else {
            $this->repository->unregister($activity, $user);
        }

        return $this->sendResponse([
            'checked' => $request->checked
        ]);
    }
}
