<?php

namespace App\Http\Controllers\Students;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Controllers\Controller as BaseController;

use Auth;
use View;
use App\Course;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
	{
        //TODO: Debería sacarlo del modelo
        $user = Auth::user();
        $courses = Course::where('grade_id', $user->grade->id)->get();

		View::share('courses', $courses);

		return parent::callAction($method, $parameters);
	}
}
