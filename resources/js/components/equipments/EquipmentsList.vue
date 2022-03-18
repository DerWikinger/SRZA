<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="equipments.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="p-1 list-item align-baseline" v-else v-for="(equipment, key) in equipments">
            <div class="p-1 row">
                <equipment-brief class="col-8" :equipment="equipment"></equipment-brief>
                <div class="offset-2 col-2 ">
                    <edit-delete-button-group
                        :id="equipment.id"
                        :token="token"
                        base-route="/equipments"
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
import EquipmentBrief from "./EquipmentBrief";
export default {
    name: "EquipmentsList",
    components: {EquipmentBrief},
    props: {
        equipments: {type: Array},
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
