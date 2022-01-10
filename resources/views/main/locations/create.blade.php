@extends('main.locations.locations')

{{--@section('title', 'Users')--}}

@section('location-content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>Новая локация</h2>
                <location-detail :location="{{ $location }}" token="{{ csrf_token() }}"
                                 :captions="{{ $captions }}" @data-changed="onDataChanged">
                </location-detail>
            </div>
        </div>
    </div>

@endsection
<script>
    import LocationDetail from "../../../js/components/locations/LocationDetail";
    export default {
        components: {LocationDetail}
    }
</script>

