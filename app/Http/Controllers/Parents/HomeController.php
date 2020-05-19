<?php

namespace App\Http\Controllers\Parents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\IParentService;
use App\Services\IStudentService;
use App\Repositories\IActivityRepository;

class HomeController extends Controller
{
    private IParentService $service;
    private IActivityRepository $activityRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IParentService $service, IActivityRepository $activityRepository)
    {
        $this->middleware('auth');
        $this->service = $service;
        $this->activityRepository = $activityRepository;
    }

	/**
	* Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
		$user = \Auth::user();

		$respuesta = $this->service->land($user);

		return view('parents/home', [
            'respuestas' => $respuesta
        ]);
    }


    public function calendars() {
		$user = \Auth::user();

        $grades = [];
        foreach($user->childrens as $student) {
            $grades[] = $student->grade;
        }

        return view('parents/calendars', [
            'grades' => $grades
        ]);
    }

    public function week() {
        $user = \Auth::user();

        $data = [];
        foreach($user->childrens as $student) {
            $data[] = [
                'activities' => $this->service->week($student),
                'grade'      => $student->grade
            ];
        }

        return view('parents/week', [
            'data' => $data
        ]);
    }
}
