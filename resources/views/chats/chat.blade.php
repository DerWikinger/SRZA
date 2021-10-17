@extends('chats.chats')

@section('chats')
    <div class="card">
        <ul class="card-body">
            @foreach($chat->messages as $message)
                <li class="list-group-item">{{ $message->content }}</li>
            @endforeach
        </ul>
    </div>
@endsection
<script>

</script>
