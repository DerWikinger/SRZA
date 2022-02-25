<template>
    <div class="location-info" @click="onClick">
        <div class="row">
            <avatar class="col-2" :model-id="this.location.id + ''" model-type="location"
                    :avatar="this.location.avatar"></avatar>
            <div class="description col-10 ">
                <strong>{{ this.location.name }}</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "LocationBrief",
    components: {Avatar},
    props: {
        location: {type: Object},
    },
    methods: {
        onClick() {
            let showPath = '/locations/' + this.location.id;
            location = showPath;
        },
    },
}
</script>

<style scoped>

.location-info .row div {
    cursor: pointer;
    display: inline-block;
}

.description {
    font-size: 1.5rem;
}
/*.location-info div {*/
/*    display: inline-block;*/
/*    !*margin: 0 1rem;*!*/
/*}*/

</style>
