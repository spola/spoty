<?php

namespace App\Http\Controllers\Parents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\IParentService;

class HomeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IParentService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
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
}
