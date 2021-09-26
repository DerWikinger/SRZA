@extends('layouts.master')

{{--@section('title', 'Users')--}}

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Users list</h2>
                @foreach($users as $user)
                    <user-info :user="{{ $user }}" v-on:data-changed="userDataChanged" token="{{ csrf_token() }}">
                        <strong slot="header">{{ $user->nickname }}</strong>
                        <input class="form-control " type="text" id="role" slot="role" value="{{ $user->role->name }}">
                    </user-info>
                @endforeach
                @if($totalPages > 1)
                    <ul class="pagination">
                        @if($page > 1)
                            <a href="{{route('users', ['page' => $page - 1])}}">
                                <li class="page-item page-link
                                   @if($page <= 1) disabled @endif">
                                    <span>&laquo;</span>
                                </li>
                            </a>
                        @else
                            <li class="page-item page-link"><span>&laquo;</span></li>
                        @endif
                        @if($page == 1)
                            <li class="page-item page-link active"><span>{{ $page }}</span></li>
                        @elseif($page == $totalPages && $totalPages > 2)
                            <a href="{{route('users', ['page' => $page - 2])}}">
                                <li class="page-item page-link">
                                    <span>{{$page - 2}}</span>
                                </li>
                            </a>
                        @else
                            <a href="{{route('users', ['page' => $page - 1])}}">
                                <li class="page-item page-link">
                                    <span>{{$page - 1}}</span>
                                </li>
                            </a>
                        @endif
                        @if(($page > 1 && $page < $totalPages) || $page == 2)
                            <li class="page-item page-link active"><span>{{ $page }}</span></li>
                        @elseif($page == 1)
                            <a href="{{route('users', ['page' => 2])}}">
                                <li class="page-item page-link">
                                    <span>{{ 2 }}</span>
                                </li>
                            </a>
                        @else
                            <a href="{{route('users', ['page' => $page - 1])}}">
                                <li class="page-item page-link">
                                    <span>{{ $page - 1 }}</span>
                                </li>
                            </a>
                        @endif
                        @if($totalPages > 2)
                            @if($page == 1)
                                <a href="{{route('users', ['page' => 3])}}">
                                    <li class="page-item page-link">
                                        <span>{{ 3 }}</span>
                                    </li>
                                </a>
                            @elseif($page < $totalPages)
                                <a href="{{route('users', ['page' => $page + 1])}}">
                                    <li class="page-item page-link">
                                        <span>{{ $page + 1 }}</span>
                                    </li>
                                </a>
                            @else
                                <li class="page-item page-link active"><span>{{ $page }}</span></li>
                            @endif
                        @endif
                        @if($page < $totalPages)
                            <a href="{{route('users', ['page' => $page + 1])}}">
                                <li class="page-item page-link
                                   @if($page >= $totalPages) disabled @endif">
                                    <span>&raquo;</span>
                                </li>
                            </a>
                        @else
                            <li class="page-item page-link"><span>&raquo;</span></li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>



    {{--{{ __('users.list') }}--}}
    {{--    {{ $users->links() }}--}}

@endsection
<script>
    // import UserInfo from "../../js/components/UserInfo";
    //
    // export default {
    //     components: {UserInfo}
    // }
    // export default {
    //     methods: {
    //             dataChanged(data) {
    //
    //             }
    //     }
    // }
</script>
