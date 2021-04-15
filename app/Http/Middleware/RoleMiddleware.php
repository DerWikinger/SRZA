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
            if ($role == 'admin' && auth()->user()->role->id === 1) {
                return $next($request);
            }
            if ($role == 'member' && auth()->user()->role->name == 'member') {
                return $next($request);
            }
        }

        return response()->view('home', ['error' => 'Unauthorized'], 401);
    }
}
