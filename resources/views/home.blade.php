@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('app.dashboard') }}</div>

                    <div class="card-body text-center">
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
        </div>
    </div>
@endsection
