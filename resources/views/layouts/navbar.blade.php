<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm h-25 text-sm ">
    <div class="container">
        <a class="navbar-brand !text-sm " href="{{ route('home') }}">
            {{ __('menu.home') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <a class="navbar-brand !text-sm " href="{{ route('locations.list') }}">
                        {{ __('menu.equipment') }}
                    </a>
                    <a class="navbar-brand !text-sm " href="{{ route('dictionaries.all') }}">
                        {{ __('menu.dictionaries') }}
                    </a>
{{--                    <a class="navbar-brand" href="{{ route('locations.units.list', [ 1 ]) }}">--}}
{{--                        {{ __('menu.units') }}--}}
{{--                    </a>--}}
{{--                    <a class="navbar-brand" href="{{ route('cabinet', ['id' => auth()->user()->id]) }}">--}}
{{--                        {{ __('users.cabinetNavbarIcon') }}--}}
{{--                    </a>--}}
{{--                    <a class="navbar-brand" href="{{ route('chats') }}">--}}
{{--                        {{ __('users.chatsNavbarIcon') }}--}}
{{--                    </a>--}}
{{--                    <a class="navbar-brand" href="{{ route('profile', ['id' => auth()->user()->id]) }}">--}}
{{--                        {{ __('users.profileNavbarIcon') }}--}}
{{--                    </a>--}}

                    @can('view-users')
                        <a class="navbar-brand text-sm " href="{{ route('users') }}">
                            {{ __('users.usersNavbarIcon') }}
                        </a>
                    @endcan
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                        </li>
                    @endif
{{--                    @if (Route::has('register'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

