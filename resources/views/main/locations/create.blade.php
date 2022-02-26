@extends('main.locations.locations')

{{--@section('title', 'Users')--}}

@section('location-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $location->id )
                    <caption-block value="{{__('caption.edit-location')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.new-location')}}" route="{{ $back }}"></caption-block>
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

