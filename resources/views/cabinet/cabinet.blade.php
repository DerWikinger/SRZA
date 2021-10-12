@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="cabinetTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="true">{{__('users.profile')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                           aria-controls="contacts" aria-selected="false">{{__('users.contacts')}}</a>
                    </li>
                </ul>
                <div class="tab-content" id="cabinetTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div>
                            @include('cabinet.profile', ['user' => $user, 'saved' => @is_null($saved) ? null : $saved ])
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div>
                            @include('cabinet.contacts', ['user' => $user])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
