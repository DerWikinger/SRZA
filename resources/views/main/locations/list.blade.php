@extends('main.locations.locations')

@section('title', __('caption.app-name'))

@section('location-content')

    <div class="container h-100">
        <data-objects-list :data-objects="{{ collect($locations)->map( function (\App\Models\Location $location) {
                    return [
                        'id' => $location->id,
                        'name' => $location->name,
                        'avatar' => $location->avatar ?? '',
                        ];
                } ) }}" token="{{ csrf_token() }}"
                           data-type="location"
                           :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
            <template v-slot:list-tittle>
                <div class="card-header">
                    <caption-block value="{{__('caption.locations')}}" route="{{ $back }}"></caption-block>
                </div>
            </template>
            <template v-slot:list-footer>
                <div class="flex">
                    <add-button class="" route="{{ route('locations.create') }}">
                        {{ __('caption.new-location') }}
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
    import LocationsList from "../../../js/components/locations/LocationsList";
    import AddButton from "../../../js/components/global/AddButton";
    import DataObjectsList from "../../../js/components/main/DataObjectsList";

    export default {
        components: {DataObjectsList, AddButton, LocationsList},
        methods: {}
    }
</script>
