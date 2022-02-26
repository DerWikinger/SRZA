@extends('main.cells.cells')

@section('title', __('caption.app-name'))

@section('cell-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $cell->id )
                    <caption-block value="{{__('caption.edit-cell')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.new-cell')}}" route="{{ $back }}"></caption-block>
                @endif
                <cell-detail :cell="{{ $cell }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged"
                                 @data-reset="onDataReset">
                </cell-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import CellDetail from "../../../js/components/cells/CellDetail";

    export default {
        components: {CellDetail}
    }
</script>

