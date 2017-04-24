<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Admin
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
        if (User::find(cas()->user())->role != 'admin')
        {
            if ($request->ajax())
            {
              return response('Unauthorized.', 401);
            }
            else
            {
              return redirect('/');
            }
        }

        return $next($request);
    }
}
