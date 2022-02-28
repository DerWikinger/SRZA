@extends('layouts.master')

@section('content')
    @yield('dictionary-content')
@endsection

@section('footer-content')
    <div class="">
        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-menu-content">
                            <div class="float-right">
                                @if(isset($back))
                                    <return-button route="{{ $back }}">
                                        <arrow-left></arrow-left>
                                    </return-button>
                                @endif
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
                                @MitrofanovVI
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection