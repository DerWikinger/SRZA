<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="cells.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="flex justify-between border-b border-gray-300 py-1 align-baseline" v-else v-for="(cell, key) in cells">
                <cell-brief class="w-4/5" :cell="cell"></cell-brief>
                <div class="w-1/5">
                    <edit-delete-button-group
                        :id="cell.id"
                        :token="token"
                        base-route="/cells"
                        :delete-permission="deletePermission">
                    </edit-delete-button-group>
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

</style>
