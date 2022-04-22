<template>
    <div class="hover:cursor-pointer" @click="onClick">
        <div class="flex items-center text-lg mt-2">
            <avatar class="w-1/6 -mt-2" :model-id="this.location.id + ''" model-type="location"
                    :avatar="this.location.avatar"></avatar>
            <div class="w-5/6">
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

</style>
