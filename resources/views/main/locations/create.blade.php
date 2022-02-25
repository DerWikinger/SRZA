@extends('main.locations.locations')

{{--@section('title', 'Users')--}}

@section('location-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $location->id )
                    <h2 class="text-primary text-capitalize">{{__('caption.edit-location')}}</h2>
                @else
                    <h2 class="text-primary text-capitalize">{{__('caption.new-location')}}</h2>
                @endif
                <location-detail :location="{{ $location }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged"
                                 @data-reset="onDataReset">
                </location-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import LocationDetail from "../../../js/components/locations/LocationDetail";

    export default {
        components: {LocationDetail}
    }
</script>

