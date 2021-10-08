@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="cabinetTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="seacrh-tab" data-toggle="tab" href="#search" role="tab"
                           aria-controls="search" aria-selected="false">Search</a>
                    </li>
                </ul>
                <div class="tab-content" id="cabinetTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" data-toggle="tab"
                         aria-labelledby="profile-tab">
                        <div>
                            @include('cabinet.profile', ['user' => $user])
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="contacts" role="tabpanel" data-toggle="tab"
                         aria-labelledby="contacts-tab">
                        <div>
                            @include('cabinet.contacts', ['user' => $user])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
