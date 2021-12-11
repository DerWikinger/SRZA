<?php

namespace App\Http\Controllers\Chats;

use App\Events\NewChatMessage;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use http\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index($id = 0)
    {
        if ($id) {
            $chat = Chat::find($id);
            if (!$chat) abort(401);
            return view('chats.chat')->with('chat', $chat);
        }

        $userId = auth()->id();
        $user = User::find($userId);
        if ($user) {
            return view('chats.list')->with('user', $user);
        }
        abort(404);
    }

    public function all(Request $request)
    {
        $matches = [];
        preg_match('/^chats\/\d*/', $request->path(), $matches);
        $chatId = (int)str_replace('chats/', '', $matches[0]) ?? 0;
        $chat = Chat::find($chatId);
        if (!$chat) abort(404);
        $collect = collect($chat->messages->map(function ($message) use ($chat) {
            return [
                "userId" => $message->user_id,
                "text" => $message->content,
                "created" => $message->created_at,
                "changed" => $message->updated_at
            ];
        }))->sortBy(['created', 'changed']);
        return $collect;
    }

    public function broadcast(Request $request)
    {
        if (!$request->filled('message')) {
            return Response::json([
                'message' => 'No message to send'
            ], 433);
        }

        $message = new \App\Models\Message();
        $message->user_id = (int)$request->user;
        $message->chat_id = (int)$request->chat;
        $message->content = $request->message;
        if ($message->save()) {
            event(new NewChatMessage($request->message, $request->chat, $request->user));
            return Response::json([], 200);
        }

        abort(500);
    }
}
