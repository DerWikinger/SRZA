<template>
    <div class="equipment-block" @click="onClick">
        <div class="row">
            <avatar class="col-2" :model-id="this.equipment.id + ''" model-type="equipment"
                    :avatar="this.equipment.avatar"></avatar>
            <div class="equipment-info col-10">
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

.equipment-block .row div {
    cursor: pointer;
    display: inline-block;
    font-size: 1rem;
}

/*.equipment-info * {*/
/*    display: inline-block;*/
/*    height: 100%;*/
/*}*/

.equipment-info:after {
    content: '';
    line-height: 100%;
    height: 100%;
    vertical-align: middle;
    display: inline-block;
}

</style>
