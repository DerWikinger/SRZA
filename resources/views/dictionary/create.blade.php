@extends('dictionary.dictionary')

@section('title', __('caption.app-name'))

@section('dictionary-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if( $object->id )
                        <caption-block value="{{__('caption.dictionary-edit-element')}}" route="{{ $back }}"></caption-block>
                @else
                    <caption-block value="{{__('caption.dictionary-new-element')}}" route="{{ $back }}"></caption-block>
                @endif
                <dictionary-detail :object="{{ $object }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged"
                                 :dictionary-id="{{ $dictionaryId }}" @data-reset="onDataReset">
                </dictionary-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import DictionaryDetail from "../../../js/components/dictionaries/DictionaryDetail";

    export default {
        components: {DictionaryDetail}
    }
</script>

