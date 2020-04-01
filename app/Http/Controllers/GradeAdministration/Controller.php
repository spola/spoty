<?php

namespace App\Http\Controllers\GradeAdministration;

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
        $user = Auth::user();

        $grades = [];
        foreach($user->adminGrades as $grade) {
            $grades[] = (object)[
                'id' => $grade->id,
                'name' => $grade->name
            ];
        }

        View::share('grades', $grades);

		return parent::callAction($method, $parameters);
	}
}
