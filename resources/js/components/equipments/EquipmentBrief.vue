<template>
    <div class="hover:cursor-pointer" @click="onClick">
        <div class="flex items-center text-lg mt-2">
            <avatar class="w-1/6 -mt-2" :model-id="this.equipment.id + ''" model-type="equipment"
                    :avatar="this.equipment.avatar"></avatar>
            <div class="w-5/6 flex">
                <strong>{{ this.equipment.equipment_type }}&nbsp;:&nbsp;</strong>
                <strong>{{ this.equipment.mark }}&nbsp;</strong>
                <strong>&laquo;{{ this.equipment.schema_label }}&raquo;</strong>
            </div>
        </div>
    </div>
</template>

<script>
import Avatar from "../global/Avatar";

export default {
    name: "EquipmentBrief",
    components: {Avatar},
    props: {
        equipment: {type: Object},
    },
    methods: {
        onClick() {
            let showPath = '/equipments/' + this.equipment.id;
            window.location = showPath;
        },
    },
}
</script>

<style scoped>


</style>
