@extends('main.locations.locations')

@section('title', __('caption.app-name'))

@section('location-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 ">
                <div class="card-header">
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
                <units-list class="" :units="{{ collect( $location->units)->map( function (\App\Models\Unit $unit) use($location) {
                    return [
                        'id' => $unit->id,
                        'name' => $unit->name,
                        'avatar' => $unit->avatar ?? '',
                        'location_id' => $location->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                            :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() }}">
                    <template v-slot:list-tittle>
                        <h2 class="p-1 color-caption text-capitalize">{{__('caption.units')}}:</h2>
                    </template>
                    <template v-slot:list-empty>
                        <br>
                        <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
                    </template>
                    <template v-slot:list-footer>
                        <div class="row">
                            <div class="col-12">
                                <div class="col-3">
                                    <add-button route="{{ url('/units/create/' . $location->id) }}">
                                        {{ __('caption.new-unit') }}
                                    </add-button>
                                </div>
                            </div>
                        </div>
                    </template>
                </units-list>
            </div>
        </div>
    </div>

@endsection
<script>
    import LocationBrief from "../../../js/components/locations/LocationBrief";

    export default {
        components: {LocationBrief}
    }
</script>
