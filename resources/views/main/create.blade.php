@extends('main.main')

@section('title', __('caption.app-name'))

@section('main-content')

    <div class="container">
        <div class="flex-column justify-center">
            @if( $model->id )
                <caption-block value="{{__('caption.edit-' . $type)}}" route="{{ $back }}"></caption-block>
            @else
                <caption-block value="{{__('caption.new-' . $type)}}" route="{{ $back }}"></caption-block>
            @endif
            <data-object-detail :data-object="{{ $model }}"
                                token="{{ csrf_token() }}"
                                :fields="{{ $fields }}"
                                data-type="{{ $type }}"
                                :captions="{{ $captions }}"
                                @data-changed="onDataChanged"
                                @data-reset="onDataReset">
            </data-object-detail>

        </div>
    </div>

@endsection

