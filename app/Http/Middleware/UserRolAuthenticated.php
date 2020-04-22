<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Auth\AuthenticationException;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;


class UserRolAuthenticated //extends Middleware
{

	    /**
     * @var array
     */
    protected $role = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $role = $guards[0];
        $this->role = $role;

        $user = $request->user();


        if($user->{'is_' . $role}) {
            return $next($request);
        }

        return $this->redirectTo($request);

    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return redirect('/');
        } else {
            return abort(403, 'Access denied');
        }
    }
}
