@extends('main.main')

@section('title', __('caption.app-name'))

@section('main-content')

    <div class="container h-100">
        <data-objects-list :data-objects="{{ collect($data)->map( function ($model) {
                    return [
                        'id' => $model->id,
                        'name' => $model->name,
                        'mark' => $model->mark ?? '',
                        'model' => $model->model ?? '',
                        'schema_label' => $model->schema_label ?? '',
                        'equipment_type' => ($model->equipmentType ? $model->equipmentType->name : null),
                        'number' => $model->number ?? 0,
                        'avatar' => $model->avatar ?? '',
                        ];
                } ) }}"
                           token="{{ csrf_token() }}"
                           data-type="{{ $type }}"
                           :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
            <template v-slot:list-tittle>
                <div class="flex">
                    <caption-block value="{{__('caption.' . $collectionName)}}" route="{{ $back }}"></caption-block>
                </div>
            </template>
            <template v-slot:list-footer>
                @if($root)
                    <div class="flex">
                        <add-button class="" route="{{ route($collectionName . '.create') }}">
                            {{ __('caption.new-' . $type) }}
                        </add-button>
                    </div>
                @endif
            </template>
        </data-objects-list>

        {{--                @if($totalPages > 1)--}}
        {{--                    <ul class="pagination">--}}
        {{--                        @if($page > 1)--}}
        {{--                            <a href="{{route('users', ['page' => $page - 1])}}">--}}
        {{--                                <li class="page-item page-link--}}
        {{--                                   @if($page <= 1) disabled @endif">--}}
        {{--                                    <span>&laquo;</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @else--}}
        {{--                            <li class="page-item page-link"><span>&laquo;</span></li>--}}
        {{--                        @endif--}}
        {{--                        @if($page == 1)--}}
        {{--                            <li class="page-item page-link active"><span>{{ $page }}</span></li>--}}
        {{--                        @elseif($page == $totalPages && $totalPages > 2)--}}
        {{--                            <a href="{{route('users', ['page' => $page - 2])}}">--}}
        {{--                                <li class="page-item page-link">--}}
        {{--                                    <span>{{$page - 2}}</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @else--}}
        {{--                            <a href="{{route('users', ['page' => $page - 1])}}">--}}
        {{--                                <li class="page-item page-link">--}}
        {{--                                    <span>{{$page - 1}}</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @endif--}}
        {{--                        @if(($page > 1 && $page < $totalPages) || $page == 2)--}}
        {{--                            <li class="page-item page-link active"><span>{{ $page }}</span></li>--}}
        {{--                        @elseif($page == 1)--}}
        {{--                            <a href="{{route('users', ['page' => 2])}}">--}}
        {{--                                <li class="page-item page-link">--}}
        {{--                                    <span>{{ 2 }}</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @else--}}
        {{--                            <a href="{{route('users', ['page' => $page - 1])}}">--}}
        {{--                                <li class="page-item page-link">--}}
        {{--                                    <span>{{ $page - 1 }}</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @endif--}}
        {{--                        @if($totalPages > 2)--}}
        {{--                            @if($page == 1)--}}
        {{--                                <a href="{{route('users', ['page' => 3])}}">--}}
        {{--                                    <li class="page-item page-link">--}}
        {{--                                        <span>{{ 3 }}</span>--}}
        {{--                                    </li>--}}
        {{--                                </a>--}}
        {{--                            @elseif($page < $totalPages)--}}
        {{--                                <a href="{{route('users', ['page' => $page + 1])}}">--}}
        {{--                                    <li class="page-item page-link">--}}
        {{--                                        <span>{{ $page + 1 }}</span>--}}
        {{--                                    </li>--}}
        {{--                                </a>--}}
        {{--                            @else--}}
        {{--                                <li class="page-item page-link active"><span>{{ $page }}</span></li>--}}
        {{--                            @endif--}}
        {{--                        @endif--}}
        {{--                        @if($page < $totalPages)--}}
        {{--                            <a href="{{route('users', ['page' => $page + 1])}}">--}}
        {{--                                <li class="page-item page-link--}}
        {{--                                   @if($page >= $totalPages) disabled @endif">--}}
        {{--                                    <span>&raquo;</span>--}}
        {{--                                </li>--}}
        {{--                            </a>--}}
        {{--                        @else--}}
        {{--                            <li class="page-item page-link"><span>&raquo;</span></li>--}}
        {{--                        @endif--}}
        {{--                    </ul>--}}
        {{--                @endif--}}
    </div>

@endsection
