@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <ul class="card-body">
                        @foreach($user->chats as $chat)
                            <chat-brief :chat="{{ $chat }}" :last="{{ $chat->lastMessage() }}" :user="{{ $user }}"
                                        :users="{{ $chat->users->map( function($user) {
                return [
                    'name' => $user->name,
                    'id' => $user->id,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'nickname' => $user->nickname,
                ];
            }) }}">
                            </chat-brief>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    import ChatBrief from "../../js/components/chats/ChatBrief";

    export default {
        components: {ChatBrief}
    }
</script>
