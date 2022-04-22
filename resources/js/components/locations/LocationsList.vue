<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="flex justify-between border-b border-gray-300 py-1 align-baseline " v-for="(location, key) in locations">
            <location-brief class="w-4/5" :location="location"></location-brief>
            <div class="w-1/5">
                <edit-delete-button-group
                    :id="location.id"
                    :token="token"
                    base-route="/locations"
                    :delete-permission="deletePermission">
                </edit-delete-button-group>
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


</style>
