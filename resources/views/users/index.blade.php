@extends('layouts.master')

@section('title', 'Users')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Users list</h2>
                @foreach($users as $user)
                        <user-info :user="{{ $user }}">
                            <b slot="header">{{ $user->nickname }}</b>
                            <div slot="role">Role: {{ $user->role->name }}</div>
                        </user-info>
                @endforeach
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
                    @if($page - 2 >= 1)
                        <a href="{{route('users', ['page' => $page - 2])}}">
                            <li class="page-item page-link">
                                <span>{{$page - 2}}</span>
                            </li>
                        </a>
                    @endif
                    @if($page - 1 >= 1)
                        <a href="{{route('users', ['page' => $page - 1])}}">
                            <li class="page-item page-link">
                                <span>{{$page - 1}}</span>
                            </li>
                        </a>
                    @endif
                    <li class="page-item page-link active"><span>{{ $page }}</span></li>
                    @if($page + 1 <= $totalPages)
                        <a href="{{route('users', ['page' => $page + 1])}}">
                            <li class="page-item page-link">
                                <span>{{$page + 1}}</span>
                            </li>
                        </a>
                    @endif
                    @if($page + 2 <= $totalPages)
                        <a href="{{route('users', ['page' => $page + 2])}}">
                            <li class="page-item page-link">
                                <span>{{$page + 2}}</span>
                            </li>
                        </a>
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
</script>
