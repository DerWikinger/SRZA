@extends('layouts.master')

@section('title', 'User info')

@section('content')
<div>
    Id: {{ $user['id'] }}
</div>
<div>
    Name: {{ $user['name'] }}
</div>
<div>
    Login: {{ $user['login'] }}
</div>
<div>
    Email: {{ $user['email'] }}
</div>
@endsection
