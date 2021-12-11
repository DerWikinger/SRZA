<?php

namespace App\Http\Middleware;

use Closure;
use Dotenv\Util\Regex;
use Illuminate\Http\Request;
use League\CommonMark\Util\RegexHelper;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $path)
    {
        $matches = [];
        $id = 0;
        if(preg_match('/^' . $path .'\/\d+.*/', $request->path(), $matches)) {
            preg_match('/\d+/', $matches[0], $matches);
            $id = (int)$matches[0];
        }
        if (!$id || auth()->id() == $id) {
            return $next($request);
        }
        return response()->view('users.authorize', ['error' => 'Unauthorized'], 401);
    }
}
