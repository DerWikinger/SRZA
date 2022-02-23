<template>
    <div class="unit-info" @click="onClick">
        <div class="row">
            <avatar class="col-2" :model-id="this.unit.id + ''" model-type="unit"
                    :avatar="this.unit.avatar"></avatar>
            <div class="description col-10 ">
                <strong>{{ this.unit.name }}</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "UnitBrief",
    components: {Avatar},
    props: {
        unit: {type: Object},
    },
    methods: {
        onClick() {
            let showPath = '/units/' + this.unit.id;
            location = showPath;
        },
    },
}
</script>

<style scoped>

.unit-info .row div {
    cursor: pointer;
    display: inline-block;
}

</style>
