@extends('layouts.master')

@section('title', 'Users')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($users as $user)

                    <div class="card">
                        <div class="card-header">
                            User '{{ $user['name'] }}'
                        </div>
                        <div class="card-body">
                            @include('users.brief', ['user' => $user])
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>



    {{--{{ __('users.list') }}--}}
    {{--    {{ $users->links() }}--}}

@endsection
