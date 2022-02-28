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
                                <div class="dictionary-brief" @click="onClick">
                                    <div class="description col-10 ">
                                        <strong>{{ $dictionary->name }}</strong>
                                    </div>
                                </div>
                                {{--                                <div class="button-group offset-2 col-2 ">--}}
                                {{--                                    <div class="button" @click="onDelete(cell.id)" v-show="deletePermission == 1">--}}
                                {{--                                        <i class="fas fa-cut" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"--}}
                                {{--                                           :id="btnDeleteName(cell.id)"--}}
                                {{--                                           @mouseover="onMouseOver(btnDeleteName(cell.id))"--}}
                                {{--                                           @mouseleave="onMouseLeave(btnDeleteName(cell.id))"></i>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="button" @click="onEdit(cell.id)">--}}
                                {{--                                        <i class="fas fa-pencil-alt" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"--}}
                                {{--                                           :id="btnEditName(cell.id)"--}}
                                {{--                                           @mouseover="onMouseOver(btnEditName(cell.id))"--}}
                                {{--                                           @mouseleave="onMouseLeave(btnEditName(cell.id))"></i>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach
                @endif
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="col-3">
                            <add-button route="{{ url('/cells/create/' . 0) }}">
                                {{ __('caption.new-dictionary') }}
                            </add-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    import CellsList from "../../../js/components/cells/CellsList";
    import AddButton from "../../../js/components/global/AddButton";

    export default {
        components: {AddButton, CellsList},
        methods: {}
    }
</script>
