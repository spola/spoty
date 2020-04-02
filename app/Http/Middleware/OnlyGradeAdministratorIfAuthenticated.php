<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyGradeAdministratorIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        $grade = $request->route('grade');

        $grade = isset($grade)? ( is_numeric($grade)? (int)$grade : $grade->id ) : null;
/*
        \DB::listen(function($query) {
            dd([
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' =>$query->time
            ]);
        });
*/
//dd($grade);

        if(!isset($grade)) {
            dd("redirigiendo por falta de grade");
            return redirect('/');
        }

        $cant = $user->adminGrades()->where('grade_id', $grade)->count();

        if ( $user == null || $cant < 1 ) {
            dd("No hay grados suficientes");
            return redirect('/');
        }

        return $next($request);
    }
}
