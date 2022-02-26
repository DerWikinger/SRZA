<template>
    <div class="cell-info" @click="onClick">
        <div class="row">
            <avatar class="col-2" :model-id="this.cell.id + ''" model-type="cell"
                    :avatar="this.cell.avatar"></avatar>
            <div class="col-1">
                <strong>{{ this.cell.number }}<span>&nbsp;-&nbsp;</span></strong>
            </div>
            <div class="description col-9 ">
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

.cell-info .row div {
    cursor: pointer;
    display: inline-block;
}

</style>
