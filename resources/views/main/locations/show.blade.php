@extends('main.locations.locations')

@section('title', __('caption.app-name'))

@section('location-content')

    <div class="container h-100">
        <div class="flex">
            <caption-block
                value="{{ __('caption.show-location') . ': ' . $location->name }}"
                route="{{ $back }}"
                align="center"
            ></caption-block>
        </div>
        {{--                <h3 class="card-header text-center">--}}
        {{--                    <avatar class="" model-id="{{ $location->id }}" model-type="location"--}}
        {{--                            avatar="{{ $location->avatar }}"></avatar>--}}
        {{--                    <span class="color-caption">{{ __('caption.show-location') . ': ' . $location->name }}</span>--}}
        {{--                </h3>--}}
        <data-objects-list class="" :data-objects="{{ collect( $location->units)->map( function (\App\Models\Unit $unit) use($location) {
                    return [
                        'id' => $unit->id,
                        'name' => $unit->name,
                        'avatar' => $unit->avatar ?? '',
                        'location_id' => $location->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                           data-type="unit"
                           :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
            <template v-slot:list-tittle>
                <h2 class="p-1 color-caption text-capitalize">{{__('caption.units')}}:</h2>
            </template>
            <template v-slot:list-empty>
                <br>
                <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
            </template>
            <template v-slot:list-footer>
                <div class="flex">
                    <add-button route="{{ url('/units/create/' . $location->id) }}">
                        {{ __('caption.new-unit') }}
                    </add-button>
                </div>
    </div>
    </div>
    </template>
    </units-list>
    </div>

@endsection
<script>
    import DataObjectsList from "../../../js/components/main/DataObjectsList";

    export default {
        components: {DataObjectsList}
    }
</script>

