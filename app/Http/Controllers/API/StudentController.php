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
use App\Services\IStudentService;

class StudentController extends ResponseController
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IStudentService $service)
    {
        $this->service = $service;
    }

    public function pending(Request $request) {
        $user = $request->user();

        $data = $this->service->landActivities($user);

        return $this->sendResponse($data);
    }
}
