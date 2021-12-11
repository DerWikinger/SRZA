@extends('chats.chats')

@section('chats')
    <div class="card">
        <chat user-id="{{ auth()->id() }}" chat-id="{{ $chat->id }}" token="{{ csrf_token() }}"></chat>
    </div>
@endsection
<script>
    import Chat from "../../js/components/chats/Chat";
    export default {
        components: {Chat}
    }
</script>
