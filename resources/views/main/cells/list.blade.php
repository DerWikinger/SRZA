@extends('main.cells.units')

@section('title', __('caption.app-name'))

@section('cell-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <cells-list :cells="{{ collect($cells)->map( function (\App\Models\Cell $cell) use($foreign_id) {
                    return [
                        'id' => $cell->id,
                        'number' => $cell->number,
                        'name' => $cell->name,
                        'avatar' => $cell->avatar ?? '',
                        'unit_id' => $foreign_id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                        :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() }}">
                    <template v-slot:list-tittle>
                        <div class="card-header">
                            <caption-block value="{{__('caption.cells')}}" route="{{ $back }}"></caption-block>
                        </div>
                    </template>
                    <template v-slot:list-empty>
                        <br>
                        <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
                    </template>
                    <template v-slot:list-footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-3">
                                    <add-button route="{{ url('/cells/create/' . $foreign_id) }}">
                                        {{ __('caption.new-cell') }}
                                    </add-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </cells-list>

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
        </div>
    </div>

@endsection
<script>
    import CellsList from "../../../js/components/cells/CellsList";
    import AddButton from "../../../js/components/global/AddButton";

    export default {
        components: {AddButton, CellsList},
        methods: {}
    }
</script>
