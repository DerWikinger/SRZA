<template>
    <div>
        <slot>
        </slot>
        <div class="p-1" v-for="(location, key) in locations">
            <location-brief :location="location"></location-brief>
        </div>
        <br>
        <input type="button" value="Создать новую" @click="onClick">
    </div>
</template>

<script>
import LocationBrief from "../locations/LocationBrief";

export default {
    name: "LocationsList",
    components: {LocationBrief},
    props: {
        locations: {type: Array},
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
