@extends('main.units.units')

@section('title', __('caption.app-name'))

@section('unit-content')

    <div class="container h-100">
                <div class="card-header">
                    <caption-block
                        value="{{ __('caption.show-unit') . ': ' . $unit->name }}"
                        route="{{ $back }}"
                        align="center"
                    ></caption-block>
                </div>
{{--                <h3 class="card-header text-center">--}}
{{--                    <avatar class="" model-id="{{ $location->id }}" model-type="location"--}}
{{--                            avatar="{{ $location->avatar }}"></avatar>--}}
{{--                    <span class="color-caption">{{ __('caption.show-location') . ': ' . $location->name }}</span>--}}
{{--                </h3>--}}
                <cells-list class="" :cells="{{ collect( $unit->cells)->map( function (\App\Models\Cell $cell) use($unit) {
                    return [
                        'id' => $cell->id,
                        'number' => $cell->number,
                        'name' => $cell->name,
                        'avatar' => $cell->avatar ?? '',
                        'unit_id' => $unit->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                            :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
                    <template v-slot:list-tittle>
                        <h2 class="p-1 color-caption text-capitalize">{{__('caption.cells')}}:</h2>
                    </template>
                    <template v-slot:list-empty>
                        <br>
                        <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
                    </template>
                    <template v-slot:list-footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-3">
                                    <add-button route="{{ url('/cells/create/' . $unit->id) }}">
                                        {{ __('caption.new-cell') }}
                                    </add-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </cells-list>
    </div>

@endsection
<script>
    // import LocationBrief from "../../../js/components/locations/LocationBrief";
    //
    // export default {
    //     components: {LocationBrief}
    // }
</script>

