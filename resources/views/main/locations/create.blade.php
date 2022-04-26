@extends('main.locations.locations')

@section('title', __('caption.app-name'))

@section('location-content')

    <div class="container">
        <div class="flex justify-center flex-column">
            @if( $location->id )
                <caption-block value="{{__('caption.edit-location')}}" route="{{ $back }}"></caption-block>
            @else
                <caption-block value="{{__('caption.new-location')}}" route="{{ $back }}"></caption-block>
            @endif
            <data-object-detail :data-object="{{ $location }}" token="{{ csrf_token() }}"
                                :fields="['name', 'description']" data-type="location"
                             :captions="{{ $captions }}" @data-changed="onDataChanged"
                             @data-reset="onDataReset">
            </data-object-detail>
        </div>
    </div>

@endsection
<script>
    import LocationDetail from "../../../js/components/locations/LocationDetail";
    import DataObjectDetail from "../../js/components/main/DataObjectDetail";

    export default {
        components: {LocationDetail}
    }
</script>

