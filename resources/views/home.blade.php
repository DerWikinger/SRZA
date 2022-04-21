@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="justify-center text-center px-20">
            <div class="text-2xl my-2">{{ __('app.dashboard') }}</div>
            <div class="text-lg my-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @auth
                    {{ __('app.logged') }}
                @endauth
                @guest
                    {{ __('app.not-logged') }}
                @endguest
            </div>
        </div>
    </div>
@endsection
