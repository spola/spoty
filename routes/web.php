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
//Route::get('login/google', 'Auth\LoginController@redirectToProvider');
//Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


//General routes
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/', function () {
        if(\Auth::user()->is_student) {
            return redirect()->route("student.home");
        } else if(\Auth::user()->is_parent) {
            return redirect()->route("parent.home");
        } else {
            return redirect("home");
        }
    });

    Route::get('/change-password',  'Auth\ChangePasswordController@index')->name('change.password');
    Route::post('/change-password', 'Auth\ChangePasswordController@store')->name('change.password.store');

    Route::get('/students/admin', 'Students\AdminController@index')->name('student.admin');
    Route::get('/students/admin/invite', 'Students\AdminController@invite')->name('student.admin.create');
    Route::post('/students/admin/invite', 'Students\AdminController@store')->name('student.admin.store');

    Route::get('/courses/{course}', 'Students\CourseController@show')->name('courses.show');
});

//Student routes
Route::name('student.')
    ->middleware(['web', 'auth'])
    ->namespace("Students")
    ->prefix('student')
    ->group(function () {

    Route::get('/', 'HomeController@index')->name('calendar');
    Route::get('/land', 'HomeController@land')->name('home');

    Route::put('/activities/register/{activity}', 'ActivityController@register')->name('activity.store');;
    Route::delete('/activities/unregister/{activity}', 'ActivityController@unregister')->name('activity.destroy');;
    Route::get('/activities/didit/{activity}', 'ActivityController@didit')->name('activity.didit');

});

//Parent routes
Route::name('parent.')
    ->middleware(['web', 'auth'])
    ->namespace("Parents")
    ->prefix('parent')
    ->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/calendars', 'HomeController@calendars')->name('calendars');
    Route::get('/week', 'HomeController@week')->name('week');
    Route::get('/grade/{grade}', 'GradeController@show')->name('grade.show');
});

Route::group(['middleware' => ['web', 'auth', 'auth.administration']], function () {
    Route::get('/administration/users/create', 'Administration\UsersController@create')->name('administration.users.create');
    Route::post('/administration/users/create', 'Administration\UsersController@store');
});

Route::name('administration.')
    ->middleware(['web', 'auth', 'auth.administration.grade'])
    ->prefix('administration')
    ->group(function () {

    Route::bind('activity', function ($id) {
        return App\Activity::withTrashed()->find($id);
    });

    Route::get('/grades/{grade}', 'GradeAdministration\GradeController@show')->name('grades.show');
    Route::get('/grades/{grade}/activity', 'GradeAdministration\GradeController@activity')->name('grades.activity.add');
    Route::post('/grades/{grade}/activity', 'GradeAdministration\GradeController@store')->name('grades.activity.store');

    Route::get('/grades/{grade}/activity/{activity}', 'GradeAdministration\GradeController@activityEdit')->name('grades.activity.edit');
    Route::post('/grades/{grade}/activity/{activity}', 'GradeAdministration\GradeController@activityUpdate')->name('grades.activity.update');

    Route::delete('/grades/{grade}/activity/{activity}', 'GradeAdministration\GradeController@activityhide')->name('grades.activity.hide');

    Route::resource('grades.users', 'Administration\GradesUsersController');
});
