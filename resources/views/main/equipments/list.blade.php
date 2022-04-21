@extends('main.equipments.equipments')

@section('title', __('caption.app-name'))

@section('equipment-content')

    <div class="container h-100">
                <equipments-list :equipments="{{ collect($equipments)->map( function (\App\Models\Equipment $equipment) {
                    return [
                        'id' => $equipment->id,
                        'mark' => $equipment->mark,
                        'model' => $equipment->model,
                        'schema' => $equipment->schema_label,
                        'type' => $equipment->equipmentType->name,
                        'avatar' => $equipment->avatar ?? '',
                        'cell_id' => $equipment->cell->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                        :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
                    <template v-slot:list-tittle>
                        <div class="card-header">
                            <caption-block value="{{__('caption.equipments')}}" route="{{ $back }}"></caption-block>
                        </div>
                    </template>
                    <template v-slot:list-footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-3">
                                    <add-button route="{{ url('/equipments/create/' . $foreign_id) }}">
                                        {{ __('caption.new-equipment') }}
                                    </add-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </equipments-list>

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
    import EquipmentsList from "../../../js/components/equipments/EquipmentsList";
    import AddButton from "../../../js/components/global/AddButton";

    export default {
        components: {AddButton, EquipmentsList},
        methods: {}
    }
</script>
