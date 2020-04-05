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
        } else if(\Auth::user()->is_parent) {
            return redirect()->route("parents.home");
        } else {
            return redirect("home");
        }
    });

    Route::get('/student', 'Students\HomeController@index')->name('student.home');

    Route::get('/courses/{course}', 'Students\CourseController@show')->name('courses.show');

    Route::get('/change-password',  'Auth\ChangePasswordController@index')->name('change.password');
    Route::post('/change-password', 'Auth\ChangePasswordController@store')->name('change.password.store');

    Route::put('/activities/register/{activity}', 'Students\ActivityController@register');
    Route::delete('/activities/unregister/{activity}', 'Students\ActivityController@unregister');

    Route::get('/students/admin', 'Students\AdminController@index')->name('student.admin');
    Route::get('/students/admin/invite', 'Students\AdminController@invite')->name('student.admin.create');
    Route::post('/students/admin/invite', 'Students\AdminController@store')->name('student.admin.store');

});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/parent', 'Parents\HomeController@index')->name('parents.home');
    Route::get('/parent/calendars', 'Parents\HomeController@calendars')->name('parents.calendars');
    Route::get('/parent/grade/{grade}', 'Parents\GradeController@show')->name('parents.grade.show');



});

Route::group(['middleware' => ['web', 'auth', 'auth.administration']], function () {

    Route::get('/administration/users/create', 'Administration\UsersController@create')->name('administration.users.create');
    Route::post('/administration/users/create', 'Administration\UsersController@store');
});

Route::group(['middleware' => ['web', 'auth', 'auth.administration.grade']], function () {

    Route::bind('activity', function ($id) {
        return App\Activity::withTrashed()->find($id);
    });

    Route::get('/administration/grades/{grade}', 'GradeAdministration\GradeController@show')->name('administration.grades.show');
    Route::get('/administration/grades/{grade}/activity', 'GradeAdministration\GradeController@activity')->name('administration.grades.activity.add');
    Route::post('/administration/grades/{grade}/activity', 'GradeAdministration\GradeController@store')->name('administration.grades.activity.store');

    Route::get('/administration/grades/{grade}/activity/{activity}', 'GradeAdministration\GradeController@activityEdit')->name('administration.grades.activity.edit');
    Route::post('/administration/grades/{grade}/activity/{activity}', 'GradeAdministration\GradeController@activityUpdate')->name('administration.grades.activity.update');

});
