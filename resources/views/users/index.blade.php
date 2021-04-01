@extends('layouts.master')

@section('title', 'Users')

@section('content')

{{--    {{ $undefined_variable }}--}}

@foreach($users as $user)

    <h3>User '{{ $user['name'] }}' info:</h3>

    @include('users.brief', ['user' => $user])

    <br>

@endforeach

{{--{{ __('users.list') }}--}}
{{--    {{ $users->links() }}--}}

@endsection
