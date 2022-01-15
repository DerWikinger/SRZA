<template>
    <div class="location-info" @click="onClick">
        <avatar :model-id="this.location.id + ''" model-type="location" :avatar="this.location.avatar"></avatar>
        <div class="description">
            <div><strong>{{ this.location.name }}</strong></div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "LocationBrief",
    components: { Avatar },
    props: {
        location: {type: Object},
    },
    methods: {
        onClick() {
            let path = '/locations/' + this.location.id;
            location = path;
        }
    },
}
</script>

<style scoped>

.location-info {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    cursor: pointer;
}

.description {
    display: inline-block;
    margin-left: 1rem;
}
</style>
