@extends('chats.chats')

@section('chats')
    <div class="card">
        <chat user-id="{{ auth()->id() }}" token="{{ csrf_token() }}"></chat>
{{--        <ul class="card-body">--}}
{{--            @foreach($chat->messages as $message)--}}
{{--                <li class="list-group-item">{{ $message->content }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
    </div>
@endsection
<script>
    import Chat from "../../js/components/chats/Chat";
    export default {
        components: {Chat}
    }
</script>
