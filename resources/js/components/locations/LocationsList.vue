<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="p-1" v-for="(location, key) in locations">
            <location-brief :location="location" @click="onClick(key)"></location-brief>
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
        button: {type: String},
    },
    methods: {
        onClick(key) {
            console.log("Key: ", key);
            window.location = '/' + key;
        },
    }
}
</script>

<style scoped>

</style>
