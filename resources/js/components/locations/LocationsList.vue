<template>
    <div>
        <div class="p-1" v-for="(location, key) in locations">
            <location-brief :location="location"></location-brief>
        </div>
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
}
</script>

<style scoped>

</style>
