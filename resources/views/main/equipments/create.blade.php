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
                                  :equipment-types="{{ collect($equipmentTypes)->
                                  map( function ($item) { return [
                                      'id' => $item->id,
                                      'name' => $item->name,
                                      'order_index' => $item->order_index ?? 0,
                                      ];}) }}"
                                  :voltage-transformer="{{ collect($voltageTransformer)->
                                  map( function ($item) { return [
                                      'id' => $item->id,
                                      'name' => $item->name,
                                      'order_index' => $item->order_index ?? 0,
                                       ];}) }}"
                                  :current-transformer="{{ collect($currentTransformer)->
                                  map( function ($item) { return [
                                      'id' => $item->id,
                                      'name' => $item->name,
                                      'order_index' => $item->order_index ?? 0,
                                       ];}) }}"
                                  :voltage-class="{{ collect($voltageClass)->
                                  map( function ($item) { return [
                                      'id' => $item->id,
                                      'name' => $item->name,
                                      'order_index' => $item->order_index ?? 0,
                                       ];}) }}"
                                  :current-class="{{ collect($currentClass)->
                                  map( function ($item) { return [
                                      'id' => $item->id,
                                      'name' => $item->name,
                                      'order_index' => $item->order_index ?? 0,
                                       ];}) }}"
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

