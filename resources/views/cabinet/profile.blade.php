<div class="card">
{{--    <div class="card-header">{{ __('users.profileCardHeader') }}</div>--}}
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
        <form method="POST" action="{{ route('profile.update') }}" name="profile"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-md-12 text-center">
                    <user-avatar avatar="{{ $user->avatar ? $user->avatar : '' }}" id="{{ $user->id }}"
                                 token="{{ csrf_token() }}">
                    </user-avatar>
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
<script>
    import UserAvatar from "../../js/components/profile/UserAvatar";

    export default {
        components: {UserAvatar}
    }
</script>
