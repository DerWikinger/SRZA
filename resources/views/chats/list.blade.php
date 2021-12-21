@extends('chats.chats')

@section('chats')
    <div class="card col-12">
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
@endsection
<script>
    import ChatBrief from "../../js/components/chats/ChatBrief";

    export default {
        components: {ChatBrief}
    }
</script>
