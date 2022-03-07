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
                                    <div class="p-2 row col-form-label">
                                        <div class="col-8"
                                             onmouseover="{{ '$("#' . 'dictionary-' . $dictionary->id . '").css({"color": "#0764b0", "text-decoration": "underline"})' }}"
                                             onmouseleave="{{ '$("#' . 'dictionary-' . $dictionary->id . '").css({"color": "#2d3748", "text-decoration": "none"})' }}"
                                             id="{{ 'dictionary-' . $dictionary->id }}">
                                            <strong>{{ $dictionary->name }}</strong>
                                        </div>
                                        <div class="offset-2 col-2 ">
                                            <edit-delete-button-group
                                                id="{{ $dictionary->id }}"
                                                token="{{ csrf_token() }}"
                                                base-route="/dictionaries"
                                                delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() }}">
                                            </edit-delete-button-group>
                                        </div>
{{--                                        <div class="direction-rtl" style="direction: rtl;">--}}
{{--                                            <div class="button-group" style="font-size:1.25rem;--}}
{{--                                                  width: max-content;--}}
{{--                                                  color:#2d3748;--}}
{{--                                                  height: 100%;">--}}
{{--                                                <i class="fas fa-pencil-alt" style="display: inline-block; vertical-align:middle;"--}}
{{--                                                   onmouseover="{{ '$("#' . class_basename($dictionary) . '").css({"color": "#ffd200", "cursor": "pointer"})' }}"--}}
{{--                                                   onmouseleave="{{ '$("#' . class_basename($dictionary) . '").css({"color": "#2d3748", "cursor": "default"})' }}"--}}
{{--                                                   id="{{ class_basename($dictionary) }}"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
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
                                <add-button route="{{ url('/dictionaries/create/' . 0) }}">
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

