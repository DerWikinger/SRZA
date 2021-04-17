@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You must authorize') }}</div>

                <div class="card-body">
                    {{ __('You must be authorized for this action.') }}
                    <br>
                    {{ __('Please refer to the administrator.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
