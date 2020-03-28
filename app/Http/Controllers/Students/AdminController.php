<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

use App\Grade;
use App\User;
use \Auth;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->is_grade_admin) {
            return redirect("/");
        }

        $students = User::where('grade_id', $user->grade_id)->get();


        return view('students/students', [
            'students' => $students
        ]);
    }

    public function invite() {
        $user = Auth::user();
        if(!$user->is_grade_admin) {
            return redirect("/");
        }

        return view('students/students_invite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = Auth::user();

        if(!$user->is_grade_admin) {
            return redirect("/");
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['grade_id'] = $user->grade_id;
        $data['is_student'] = true;
        

        $newUser = User::create($data);

        event(new Registered($newUser));

        return redirect()->route('student.admin');

    }
}
