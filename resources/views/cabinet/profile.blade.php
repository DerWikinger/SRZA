<div class="card">
    {{--    <div class="card-header">{{ __('users.profileCardHeader') }}</div>--}}
    <div class="card-body">
        @unless(@is_null($saved))
            <div class="message-saved">
                <elem-in-out-left>
                    <div slot="element">
                        @if(($saved))
                            <div class="alert alert-success" role="alert">
                                {{ __('users.dataSaved') }}
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                {{ __('users.dataNotSaved') }}
                            </div>
                        @endif
                    </div>
                </elem-in-out-left>
            </div>
        @endunless
        <form method="POST" action="{{ route('profile.update') }}" name="profile"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-12 text-center">
                    <user-avatar-change avatar="{{ $user->avatar ? $user->avatar : '' }}" id="{{ $user->id }}"
                                        token="{{ csrf_token() }}">
                    </user-avatar-change>
                </div>
            </div>

            @can('view-users')
                <div class="form-group row">
                    <label for="id"
                           class="col-md-4 col-form-label text-md-right">{{ __('users.id') }}</label>
                    <div class="col-md-6">
                        <input id="id" type="text" class="form-control " name="id" value="{{ $user->id }}"
                               required disabled>
                    </div>
                </div>
            @endcan
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
                    <button-cancel id="{{ $user->id }}" >
                        {{ __('users.cancel') }}
                    </button-cancel>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    import UserAvatarChange from "../../js/components/profile/UserAvatarChange";
    import ElemInOutLeft from "../../js/components/global/ElemInOutLeft";
    import ButtonCancel from "../../js/components/profile/ButtonCancel";

    export default {
        components: {ButtonCancel, ElemInOutLeft, UserAvatarChange},
    }
</script>
