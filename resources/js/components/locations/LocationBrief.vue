<template>
    <div class="location-info row align-baseline" @click="onClick">
        <div class="col-1 ">
            <avatar :model-id="this.location.id + ''" model-type="location" :avatar="this.location.avatar"></avatar>
        </div>
        <div class="description col-2 ">
            <strong>{{ this.location.name }}</strong>
        </div>
        <div class="button-group offset-7 col-2 ">
            <a :href="editPath">
                <i class="fas fa-pencil-alt" style="font-size:1.25rem;vertical-align:middle;color:#ffe817"></i>
            </a>
            <a :href="deletePath">
                <i class="fas fa-cut" style="font-size:1.25rem;vertical-align:middle;color:#e3342f"></i>
            </a>
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
    data() {
        return {
            editPath: '/locations/edit/' + this.location.id,
            deletePath: '/locations/delete/' + this.location.id,
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

.description, button-group *  {
    font-size: 1.5rem;
}
.button-group i {
    margin-left: 0.5rem;
}
.button-group::after {
    content: '';
    vertical-align: middle;
    line-height: 100%;
    display: inline-block;
    height: 100%;
}

</style>
