@extends('main.cells.cells')

@section('title', __('caption.app-name'))

@section('cell-content')

    <div class="container h-100">
                <div class="card-header">
                    <caption-block
                        value="{{ __('caption.show-cell') . ': №' . $cell->number . ' "' . $cell->name . '"' }}"
                        route="{{ $back }}"
                        align="center"
                    ></caption-block>
                </div>
{{--                <h3 class="card-header text-center">--}}
{{--                    <avatar class="" model-id="{{ $location->id }}" model-type="location"--}}
{{--                            avatar="{{ $location->avatar }}"></avatar>--}}
{{--                    <span class="color-caption">{{ __('caption.show-location') . ': ' . $location->name }}</span>--}}
{{--                </h3>--}}
                <equipments-list class="" :equipments="{{ collect( $cell->equipments)->map( function (\App\Models\Equipment $equipment) use($cell) {
                    return [
                        'id' => $equipment->id,
                        'mark' => $equipment->mark,
                        'model' => $equipment->model,
                        'schema_label' => $equipment->schema_label,
                        'equipment_type' => ($equipment->equipmentType ? $equipment->equipmentType->name : null),
                        'avatar' => $equipment->avatar ?? '',
                        'cell_id' => $cell->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                            :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
                    <template v-slot:list-tittle>
                        <h2 class="p-1 color-caption text-capitalize">{{__('caption.equipments')}}:</h2>
                    </template>
                    <template v-slot:list-empty>
                        <br>
                        <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
                    </template>
                    <template v-slot:list-footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-3">
                                    <add-button route="{{ url('/equipments/create/' . $cell->id) }}">
                                        {{ __('caption.new-equipment') }}
                                    </add-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </equipments-list>
    </div>

@endsection
<script>
    // import LocationBrief from "../../../js/components/locations/LocationBrief";
    //
    // export default {
    //     components: {LocationBrief}
    // }
</script>

