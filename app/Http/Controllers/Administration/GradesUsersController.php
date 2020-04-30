<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\UserCreated;

use App\Grade;
use App\User;
use \Mail;


class GradesUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Grade $grade)
    {
        return view('administration.grades.users.index', [
            'grade' => $grade
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Grade $grade)
    {
        return view('administration.grades.users.create', [
            'grade' => $grade
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $data = $request->all();

        $student = User::where('email', $data['email'])->first();
        $studentCreated = false;

        if($student == null) {
            $student = User::create([
                'name'=> $data['name'],
                'email' => $data['email'],
                'password'=>bcrypt('12345678'),
                'is_student'=>true,
                'grade_id' => $grade->id
            ]);
            $studentCreated = true;
        }

        $parent = User::where('email', $data['parent_email'])->first();
        $parentCreated = false;

        if($parent == null) {
            $parent = User::create([
                'name'=> $data['parent_name'],
                'email' => $data['parent_email'],
                'password'=>bcrypt('12345678'),
                'is_student'=>false,
                'is_parent' => true,
                'grade_id' => null
            ]);
            $parentCreated = true;
        }

        $parent->childrens()->attach($student);

        if($studentCreated) {
            Mail::to($student)->send(new UserCreated());
        }
        if($parentCreated) {
            Mail::to($parent)->send(new UserCreated());
        }

        return redirect()
            ->route('administration.grades.users.index', ['grade' => $grade])
            ->with('message', 'Creación correcta');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
