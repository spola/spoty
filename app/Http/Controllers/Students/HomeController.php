<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use \Auth;
use App\Services\IStudentService;


class HomeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IStudentService $service)
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
        $grade = Auth::user()->grade;
        return view('students/home', [
            'grade' => $grade
        ]);
    }

    public function land() {
        $user = Auth::user();

        extract( $this->service->land($user));

        return view('students.home.land', compact('activities', 'today', 'dones'));
    }
}
