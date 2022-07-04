@extends('main.main')

@section('title', __('caption.app-name'))

@section('main-content')

    <div class="container h-100">
        <div class="flex">
            <caption-block
                value="{{ __('caption.show-' . $type) . ': ' . $model->name }}"
                route="{{ $back }}"
                align="center"
            ></caption-block>
        </div>

        <data-objects-list class="" :data-objects="{{ collect( $model[$children])->map( function ($child) use($model, $type) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name ?? '',
                        'mark' => $child->mark ?? '',
                        'model' => $child->model ?? '',
                        'schema_label' => $child->schema_label ?? '',
                        'equipment_type' => ($child->equipmentType ? $child->equipmentType->name : null),
                        'number' => $child->number ?? 0,
                        'avatar' => $child->avatar ?? '',
                        $type . '_id' => $model->id,
                        ];
                } ) }}" token="{{ csrf_token() }}"
                           data-type="{{ \App\Http\Controllers\Main\MainController::getSingular($children) }}"
                           :delete-permission="{{ App\Models\User::find(auth()->id())->role == App\Models\Role::admin() ? 1 : 0 }}">
            <template v-slot:list-tittle>
                <h2 class="p-1 color-caption text-capitalize">{{__('caption.' . $children)}}:</h2>
            </template>
            <template v-slot:list-empty>
                <br>
                <h4 class="color-empty-list">{{__('caption.empty')}}</h4>
            </template>
            <template v-slot:list-footer>
                <div class="flex">
                    <add-button route="{{ url('/'. $children .'/create/' . $model->id) }}">
                        {{ __('caption.new-' . \App\Http\Controllers\Main\MainController::getSingular($children)) }}
                    </add-button>
                </div>
            </template>
        </data-objects-list>
    </div>

@endsection
<script>
    import DataObjectsList from "../../js/components/main/DataObjectsList";

    export default {
        components: {DataObjectsList}
    }
</script>

