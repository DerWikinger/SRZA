<header>
    <div class="container">
        <div class="row">
            @component('layouts.logo')
                @slot('title')
                    This is a description of Logo
                @endslot
            @endcomponent
            <div class="col-md-6">
                <h2>My Application</h2>
                <div class="sub-header">
                    @yield('subheader')
                </div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</header>



