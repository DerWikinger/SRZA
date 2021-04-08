@extends('layouts.master')

@section('title', 'User info')

@section('subheader', 'Here is a full information about user')

@section('content')

    <div>
        Id: {{ $user['id'] }}
    </div>
    <div>
        Name: {{ $user['name'] }}
    </div>
    <div>
        Login: {{ $user['nickname'] }}
    </div>
    <div>
        Email: {{ $user['email'] }}
    </div>

@endsection
