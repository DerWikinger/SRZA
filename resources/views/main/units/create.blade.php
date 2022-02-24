@extends('main.units.units')

{{--@section('title', 'Users')--}}

@section('unit-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if( $unit->id )
                    <h2 class="text-primary text-capitalize">{{__('caption.edit-unit')}}</h2>
                @else
                    <h2 class="text-primary text-capitalize">{{__('caption.new-unit')}}</h2>
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

