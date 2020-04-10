<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use \Auth;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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

    public function land() {
        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $activities = Activity::query()
            ->with('Course')
            ->whereBetween('due_date', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->orderBy('due_date', 'asc')
            ->get();

        $today = $activities->filter(function ($item) {
            return $item->due_date->isToday();
        })->first();



        $dones = null;
        if($today != null) {
            $query = "SELECT
            (select count(1) from users where grade_id = ? and is_student = 1) as total,
            (select count(1) from user_activities where activity_id = ? and deleted_at is null) as hechas";

            $dones = DB::select($query, [$today->course->grade_id, $today->id]);
            $dones = $dones[0];

            $activities = $activities->filter( function ($item) use($today) {
                return $item->id != $today->id;
            });
        }

        return view('students.home.land', compact('activities', 'today', 'dones'));
    }
}
