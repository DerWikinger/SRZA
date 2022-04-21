<header>
    <div class="container">
        <div class="flex justify-between">
            @component('layouts.logo')
                @slot('title')
{{--                    This is a description of Logo--}}
                @endslot
            @endcomponent
            <div class="w-3/5 text-center">
                <h2>{{ __('app.app-name') }}</h2>
                <div class="sub-header">
                    @yield('subheader')
                </div>
            </div>
            <div class="w-1/5">
            </div>
        </div>
    </div>
</header>



