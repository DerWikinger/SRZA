@extends('main.main')

@section('title', __('caption.app-name'))

@section('main-content')

    <div class="container">
        <div class="flex justify-center flex-column">
            @if( $model->id )
                <caption-block value="{{__('caption.edit-' . $type)}}" route="{{ $back }}"></caption-block>
            @else
                <caption-block value="{{__('caption.new-' . $type)}}" route="{{ $back }}"></caption-block>
            @endif
            <data-object-detail :data-object="{{ $model }}" token="{{ csrf_token() }}"
                                :fields="['name', 'description']" data-type="{{ $type }}"
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

