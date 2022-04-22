<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="equipments.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="flex justify-between border-b border-gray-300 py-1 align-baseline" v-else
             v-for="(equipment, key) in equipments">
            <equipment-brief class="w-4/5" :equipment="equipment"></equipment-brief>
            <div class="w-1/5">
                <edit-delete-button-group
                    :id="equipment.id"
                    :token="token"
                    base-route="/equipments"
                    :delete-permission="deletePermission">
                </edit-delete-button-group>
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

</style>
