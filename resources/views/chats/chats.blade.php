@extends('layouts.master')

@section('content')
<ul>
    @foreach($user->chats as $chat)
        <li>{{ $chat->name }}</li>
    @endforeach
</ul>
@endsection
