@extends('main.units.units')

{{--@section('title', 'Users')--}}

@section('unit-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $unit->id )
                    <caption-block value="{{__('caption.edit-unit')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.new-unit')}}" route="{{ $back }}"></caption-block>
                @endif
                <unit-detail :unit="{{ $unit }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged"
                                 @data-reset="onDataReset">
                </unit-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import UnitDetail from "../../../js/components/units/UnitDetail";

    export default {
        components: {UnitDetail}
    }
</script>

