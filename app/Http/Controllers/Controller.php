<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use View;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function callAction($method, $parameters)
	{
        $user = Auth::user();

        if(isset($user)) {

            View::share('user', $user);

            $grades = [];
            foreach($user->adminGrades as $grade) {
                $grades[] = (object)[
                    'id' => $grade->id,
                    'name' => $grade->name
                ];
            }

            View::share('grades', $grades);
        }

		return parent::callAction($method, $parameters);
	}
}
