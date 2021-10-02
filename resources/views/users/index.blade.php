@extends('layouts.master')

{{--@section('title', 'Users')--}}

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Users list</h2>
                <users-list :users="{{ collect($users)->map( function (\App\Models\User $user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => [ 'id' => $user->role->id, 'name' => $user->role->name ],
                        'verified' => $user->hasVerifiedEmail(),
                        'createdAt' => $user->created_at->toString(),
                        'nickname' => $user->nickname,
                        ];
                } ) }}"></users-list>
{{--                @foreach($users as $user)--}}
{{--                    <user-info :user="{{ $user }}" :role="{{ collect($user->role)--}}
{{--                               ->filter( function($value, $key) { if($key == "id") return $value; } ) }}"--}}
{{--                               :roles="{{ \App\Models\Role::all()--}}
{{--                                ->map( function($item) { return ["id" => $item->id, "name" =>$item->name ]; } ) }}"--}}
{{--                               v-on:data-changed="userDataChanged"--}}
{{--                               :depth="depth"--}}
{{--                               token="{{ csrf_token() }}">--}}
{{--                        <strong slot="header">{{ $user->nickname }}</strong>--}}
{{--                    </user-info>--}}
{{--                @endforeach--}}
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
    import UsersList from "../../js/components/user/UsersList";
    export default {
        components: {UsersList}
    }
</script>
