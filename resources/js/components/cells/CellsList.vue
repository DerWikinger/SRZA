<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="cells.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="list-item align-baseline" v-else v-for="(cell, key) in cells">
            <div class="row">
                <cell-brief class="col-8" :cell="cell"></cell-brief>
                <div class="offset-2 col-2 ">
                    <edit-delete-button-group
                        :id="cell.id"
                        :token="token"
                        base-route="/cells"
                        :delete-permission="deletePermission">
                    </edit-delete-button-group>
                </div>
            </div>
        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import CellBrief from "../cells/CellBrief";

export default {
    name: "CellsList",
    components: {CellBrief},
    props: {
        cells: {type: Array},
        token: {type: String},
        deletePermission: {type: Number, default: 0},
    },
}
</script>

<style scoped>

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    padding-top: 0.25rem;
    font-size: 1.5rem;
}

</style>
