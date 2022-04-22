<template>
    <div class="hover:cursor-pointer" @click="onClick">
        <div class="flex items-center text-lg mt-2">
            <avatar class="w-1/6 -mt-2" :model-id="this.cell.id + ''" model-type="cell"
                    :avatar="this.cell.avatar"></avatar>
            <div class="w-5/6 flex">
                <strong>{{ this.cell.number }}<span>&nbsp;-&nbsp;</span></strong>
                <strong>{{ this.cell.name }}</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "CellBrief",
    components: {Avatar},
    props: {
        cell: {type: Object},
    },
    methods: {
        onClick() {
            let showPath = '/cells/' + this.cell.id;
            window.location = showPath;
        },
    },
}
</script>

<style scoped>

</style>
