<template>
    <div>
        <slot name="tittle"></slot>
        <div class="p-1" v-for="(location, key) in locations">
            <location-brief :location="location"></location-brief>
        </div>
        <br>
        <slot name="button"></slot>
    </div>
</template>

<script>
import LocationBrief from "../locations/LocationBrief";

export default {
    name: "LocationsList",
    components: {LocationBrief},
    props: {
        locations: {type: Array},
        button: {type: String},
    },
    methods: {
        onClick() {
            window.location = '/locations/create';
        }
    }
}
</script>

<style scoped>

</style>
