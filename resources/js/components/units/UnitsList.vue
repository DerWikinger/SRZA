<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="units.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="flex justify-between border-b border-gray-300 py-1 align-baseline" v-else
             v-for="(unit, key) in units">
            <unit-brief class="w-4/5" :unit="unit"></unit-brief>
            <div class="w-1/5">
                <edit-delete-button-group
                    :id="unit.id"
                    :token="token"
                    base-route="/units"
                    :delete-permission="deletePermission">
                </edit-delete-button-group>
            </div>
        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import UnitBrief from "../units/UnitBrief";

export default {
    name: "UnitsList",
    components: {UnitBrief},
    props: {
        units: {type: Array},
        token: {type: String},
        deletePermission: {type: Number, default: 0},
    },
}
</script>

<style scoped>

</style>
