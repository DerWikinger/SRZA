@extends('layouts.master')

@section('title', 'Users')

@section('content')

@foreach($users as $user)

    <h3>User '{{ $user['name'] }}' info:</h3>

    @include('users.brief', ['user' => $user])

    <br>

@endforeach

@endsection
