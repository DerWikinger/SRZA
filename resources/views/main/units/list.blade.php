@extends('main.units.units')

@section('title', __('caption.app-name'))

@section('unit-content')

    <div class="container h-100">
        <data-objects-list :data-objects="{{ collect($units)->map( function (\App\Models\Unit $unit) use($foreign_id) {
                    return [
                        'id' => $unit->id,
                        'name' => $unit->name,
                        'avatar' => $unit->avatar ?? '',
                        'location_id' => $foreign_id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                           data-type="unit"
                           :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0  }}">
            <template v-slot:list-tittle>
                <div class="card-header">
                    <caption-block value="{{__('caption.units')}}" route="{{ $back }}"></caption-block>
                </div>
            </template>
            <template v-slot:list-empty>
                <br>
                <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
            </template>
            <template v-slot:list-footer>
                <div class="flex">
                    <add-button route="{{ url('/units/create/' . $foreign_id) }}">
                        {{ __('caption.new-unit') }}
                    </add-button>
                </div>
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
<script>
    import UnitsList from "../../../js/components/units/UnitsList";
    import AddButton from "../../../js/components/global/AddButton";
    import DataObjectsList from "../../../js/components/main/DataObjectsList";

    export default {
        components: {DataObjectsList, AddButton, UnitsList},
        methods: {}
    }
</script>
