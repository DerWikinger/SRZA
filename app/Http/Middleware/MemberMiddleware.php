<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $matches = [];
        $id = 0;
        if(preg_match('/^chats\/\d*/', $request->path(), $matches)) {
//            preg_match('/\d*/', $matches[0], $matches);
            $id = (int)(str_replace('chats/', '', $matches[0]));
        }

        if ((int)$id) {
            $userId = auth()->id();
            $user = User::find($userId);
            if ($user && $user->chats->map(function ($chat) {
                    return $chat->id;
                })->contains((int)$id)) {
                return $next($request);
            } else {
                return response()->view('users.authorize', ['error' => 'Unauthorized'], 401);
            }
        } else {
            return $next($request); // path == /chats
        }
    }
}
