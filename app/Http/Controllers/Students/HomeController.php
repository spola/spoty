<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use \Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
}
