@extends('layouts.master')

@section('content')
    @yield('main-content')
@endsection

@section('footer-content')
    <div class="">
        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-menu-content">
                            <div class="col-3">
                                <return-button>
                                    <div class="">{{ __('caption.btn-reset') }}</div>
                                </return-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="sub-footer-content">
                        <div class="col-12">
                            <h6>
                                @copyright: Mitrofanov VI
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
