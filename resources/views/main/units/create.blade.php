@extends('main.units.units')

@section('title', __('caption.app-name'))

@section('unit-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $unit->id )
                    <caption-block value="{{__('caption.edit-unit')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.new-unit')}}" route="{{ $back }}"></caption-block>
                @endif
                <data-object-detail :data-object="{{ $unit }}" token="{{ csrf_token() }}"
                                    :fields="['name', 'description']" data-type="unit"
                                    :captions="{{ $captions }}" @data-changed="onDataChanged"
                                    @data-reset="onDataReset">
                </data-object-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import DataObjectDetail from "../../js/components/main/DataObjectDetail";

    export default {
        components: {UnitDetail}
    }
</script>

