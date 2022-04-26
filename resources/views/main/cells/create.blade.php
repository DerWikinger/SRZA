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
                <data-object-detail :data-object="{{ $cell }}" token="{{ csrf_token() }}"
                                    :fields="['number', 'name', 'description']" data-type="cell"
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
        components: {CellDetail}
    }
</script>

