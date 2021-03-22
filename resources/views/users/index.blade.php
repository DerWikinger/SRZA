@extends('layouts.master')

@section('title', 'Users')

@section('content')

@foreach($users as $user)

@include('users.show', ['user' => $user])

<br>

@endforeach

@endsection
