@extends('main.equipments.equipments')

@section('title', __('caption.app-name'))

@section('equipment-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $equipment->id )
                    <caption-block value="{{__('caption.edit-equipment')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.new-equipment')}}" route="{{ $back }}"></caption-block>
                @endif
                <equipment-detail :equipment="{{ $equipment }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged"
                                 @data-reset="onDataReset">
                </equipment-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import EquipmentDetail from "../../../js/components/equipments/EquipmentDetail";

    export default {
        components: { EquipmentDetail }
    }
</script>

