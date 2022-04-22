<template>
    <div class="hover:cursor-pointer" @click="onClick">
        <div class="flex items-center text-lg mt-2">
            <avatar class="w-1/6 -mt-2" :model-id="this.unit.id + ''" model-type="unit"
                    :avatar="this.unit.avatar"></avatar>
            <div class="w-5/6">
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


</style>
