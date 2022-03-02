@extends('dictionary.dictionary')

@section('title', __('caption.app-name'))

@section('dictionary-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-header">
                    <caption-block value="{{__('caption.dictionaries')}}" route="{{ $back }}"></caption-block>
                </div>
                @if(count($dictionaries) == 0)
                    <div class="">
                        <br>
                        <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
                    </div>
                @else
                    @foreach($dictionaries as $dictionary)
                        <div class="row list-item align-baseline">
                            <div class="col-12">
                                <div class="dictionary-brief cursor-pointer"
                                     onclick="{{ 'window.location = "/dictionaries/' . $dictionary->id . '"'}}">
                                    <div class="description col-12 col-form-label form-control">
                                        <strong>{{ $dictionary->name }}</strong>
                                        <i class="fas fa-pencil-alt"
                                           style="font-size:1.25rem;
                                                  vertical-align:middle;
                                                  color:#2d3748;
                                                  display: inline-block;
                                                  float: right;"
                                           onmouseover="{{ '$("#' . class_basename($dictionary) . '").css({"color": "#ffd200", "cursor": "pointer"})' }}"
                                           onmouseleave="{{ '$("#' . class_basename($dictionary) . '").css({"color": "#2d3748", "cursor": "default"})' }}"
                                           id="{{ class_basename($dictionary) }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <br>
                {{--                Пока не реализовано добавление справочника из приложения--}}
                @if(false)
                    <div class="row">
                        <div class="col-12">
                            <div class="col-3">
                                <add-button route="{{ url('/cells/create/' . 0) }}">
                                    {{ __('caption.new-dictionary') }}
                                </add-button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
<script>
    import CellsList from "../../../js/components/cells/CellsList";
    import AddButton from "../../../js/components/global/AddButton";

    export default {
        components: {AddButton, CellsList},
        methods: {},
    }
</script>

