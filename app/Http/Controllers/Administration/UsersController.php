<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Grade;
use App\Mail\UserCreated;
use \Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all()->pluck('name', 'id');

        return view('administration.users.create', [
            'grades' => $grades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'grades' => ['required', 'string']
        ]);

        $data = $request->all();

        $student = User::create([ 
            'name'=> $data['name'],
            'email' => $data['email'],
            'password'=>bcrypt('12345678'),
            'is_student'=>true,
            'grade_id' => $data['grades']
        ]);

        $parent = User::create([ 
            'name'=> $data['parent_name'],
            'email' => $data['parent_email'],
            'password'=>bcrypt('12345678'),
            'is_student'=>false,
            'is_parent' => true,
            'grade_id' => null
        ]);

        $parent->childrens()->attach($student);

        Mail::to($student)->send(new UserCreated());
        Mail::to($parent)->send(new UserCreated());

        return redirect()->route('administration.users.create')->with('message', 'Creación correcta');

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
