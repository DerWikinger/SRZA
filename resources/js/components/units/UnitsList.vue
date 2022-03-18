<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="units.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="p-1 list-item align-baseline" v-else v-for="(unit, key) in units">
            <div class="p-1 row">
                <unit-brief class="col-8" :unit="unit"></unit-brief>
                <div class="offset-2 col-2 ">
                    <edit-delete-button-group
                        :id="unit.id"
                        :token="token"
                        base-route="/units"
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

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    padding-top: 0.25rem;
    font-size: 1.5rem;
}

</style>
