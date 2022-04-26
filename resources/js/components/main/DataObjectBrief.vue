<template>
    <div class="hover:cursor-pointer" @click="onClick">
        <div class="flex items-center text-lg mt-2">
            <avatar class="w-1/6 -mt-2" :model-id="this.dataObject.id + ''" :model-type="this.dataType"
                    :avatar="this.dataObject.avatar"></avatar>
            <div class="w-5/6">
                <strong>{{ this.dataObject.name }}</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "DataObjectBrief",
    components: {Avatar},
    props: {
        dataObject: {type: Object},
        dataType: {type: String},
    },
    methods: {
        onClick() {
            let showPath = '/' + this.dataType + 's/' + this.dataObject.id;
            location = showPath;
        },
    },
}
</script>

<style scoped>

</style>
