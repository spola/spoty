<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);


Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', function () {

        if(\Auth::user()->is_student) {
            return redirect()->route("student.home");
        } else {
            return redirect("home");
        }
    });

    Route::get('/student', 'Students\HomeController@index')->name('student.home');

    Route::get('/courses/{id}', 'Students\CourseController@show')->name('courses.show');

});


