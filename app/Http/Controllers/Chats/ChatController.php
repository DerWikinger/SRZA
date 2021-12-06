<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index($id)
    {
        return view('chats.chat')->with('chat', Chat::find($id));
    }

    public function broadcast(Request $request)
    {
        if (! $request->filled('message')) {
            return Response::json([
                'message' => 'No message to send'
            ], 433);
        }

//        Event::dispatch(new NewChatMessage($request->message, $request->user));
        event(new NewChatMessage($request->message, $request->user));
//        NewChatMessage::dispatch($request->message, $request->user);

        return Response::json([], 200);
    }
}
