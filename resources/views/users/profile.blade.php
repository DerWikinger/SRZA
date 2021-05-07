@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('users.profileCardHeader') }}</div>
                    <div class="card-body">
                        @unless(@is_null($saved))
                            @if(($saved))
                                <div class="">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ __('users.dataSaved') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ __('users.dataNotSaved') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endunless
                        <form method="POST" action="{{ route('profile.update') }}" name="profile" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <div class="d-inline-block">
                                        <input class="position-absolute
                                                      custom-file-input
                                                      w-rem-10
                                                      h-rem-10
                                                      cursor-pointer"
                                               value="{{ $user->avatar ? $user->avatar : 'default_avatar.jpg'  }}"
                                               accept="image/*"
                                               name="avatar_image"
                                               dir=""
                                               type="file">
                                        <img id="avatar" class="img-thumbnail
                                                                w-rem-10
                                                                h-rem-10"
                                        @if( ($user->avatar ?? '' ) != '' && (\Illuminate\Support\Facades\Storage::exists('/public/images/avatars/' . $user->id . '/' . $user->avatar)))
                                             src="{{ '/storage/images/avatars/' . $user->id . '/' . $user->avatar }}"
                                             alt="{{ $user->avatar }}"
                                        @else
                                             src= "/storage/images/avatars/default_avatar.jpg"
                                             alt= "default_avatar.jpg"
                                        @endif

                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('users.id') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control " name="id" value="{{ $user->id }}"
                                           required disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('users.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nickname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('users.nickname') }}</label>

                                <div class="col-md-6">
                                    <input id="nickname" type="text" class="form-control " name="nickname"
                                           value="{{ $user->nickname }}" autofocus>

                                    {{--                                    @error('name')--}}
                                    {{--                                    <span class="invalid-feedback" role="alert">--}}
                                    {{--                                        <strong>{{ $message }}</strong>--}}
                                    {{--                                    </span>--}}
                                    {{--                                    @enderror--}}
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('users.save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
