<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="list-item align-baseline " v-for="(location, key) in locations">
            <div class="p-1 row">
                <location-brief class="col-8" :location="location"></location-brief>
                <div class="offset-2 col-2 ">
                    <edit-delete-button-group
                        :id="location.id"
                        :token="token"
                        base-route="/locations"
                        :delete-permission="deletePermission">
                    </edit-delete-button-group>
                </div>
            </div>
        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import LocationBrief from "../locations/LocationBrief";

export default {
    name: "LocationsList",
    components: {LocationBrief},
    props: {
        locations: {type: Array},
        token: {type: String},
        deletePermission: {type: Number, default: 0},
    },
}
</script>

<style scoped>

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    padding-top: 0.25rem;
    font-size: 1.5rem;
}

</style>
