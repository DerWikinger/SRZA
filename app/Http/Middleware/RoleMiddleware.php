<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param \String $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role) {
            if ($role == 'admin' && auth()->user()->role->access_level <= 100) {
                return $next($request);
            }
            if ($role == 'member' && auth()->user()->role->access_level <= 500) {
                return $next($request);
            }
        }

        return response()->view('users.authorize', ['error' => 'Unauthorized'], 401);
    }
}
