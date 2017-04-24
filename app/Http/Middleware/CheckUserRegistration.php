<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUserRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        User::firstOrCreate(['id' => cas()->user()]);

        return $next($request);
    }
}
