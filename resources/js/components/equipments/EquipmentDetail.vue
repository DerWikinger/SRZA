<template>
    <div class="flex justify-between flex-col text-center">
        <div class="w-full flex justify-center rounded mt-2 mb-4">
            <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="equipment"
                           :confirm-message="this.captions.avatarConfirmMessage"
                           id="changeAvatar" @value-changed="onAvatarChanged">
            </avatar-change>
        </div>
        <div class="flex justify-between items-center">
            <div class="w-25 text-left font-bold">{{ this.captions.id + ':' }}</div>
            <input class="w-75 disabled:opacity-75 form-input form-text px-2 py-1 rounded " id="id" name="id" type="text"
                   v-model="this.id" disabled>
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.equipment_type + ':' }}</div>
            <select class="w-75 form-input form-number px-2 py-1 rounded" type="text" id="equipment_type" name="equipment_type"
                    v-model="equipment.equipment_type"
                    @change="onDataChanged">
                <option class="" v-for="(equipmentType, key) in this.orderedEquipmentTypes" :value="equipmentType.id">
                    {{ equipmentType.name }}
                </option>
            </select>
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.mark + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="mark" name="mark" v-model.trim="equipment.mark"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.model + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="model" name="model" v-model.trim="equipment.model"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.schema_label + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="schema_label" name="schema_label"
                   v-model.trim.lazy="equipment.schema_label"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.voltage_class + ':' }}</div>
            <select class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="voltage_class" name="voltage_class"
                    v-model="equipment.voltage_class"
                    @change="onDataChanged">
                <option class="" v-for="(voltageClass, key) in this.orderedVoltageClass" :value="voltageClass.id">
                    {{ voltageClass.name }}
                </option>
            </select>
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.current_class + ':' }}</div>
            <select class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="current_class" name="current_class"
                    v-model="equipment.current_class"
                    @change="onDataChanged">
                <option class="" v-for="(currentClass, key) in this.orderedCurrentClass" :value="currentClass.id">
                    {{ currentClass.name }}
                </option>
            </select>
        </div>
        <div class="flex justify-between items-center mt-1" id="VT">
            <div class="w-25 text-left font-bold">{{ this.captions.ratio + ':' }}</div>
            <select class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="ratioV" name="ratioV" v-model="equipment.ratio"
                    @change="onDataChanged">
                <option class="" v-for="(voltageRatio, key) in this.orderedVoltageTransformer"
                        :value="voltageRatio.id">{{ voltageRatio.name }}
                </option>
            </select>
        </div>
        <div class="flex justify-between items-center mt-1" id="CT">
            <div class="w-25 text-left font-bold">{{ this.captions.ratio + ':' }}</div>
            <select class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="ratioC" name="ratioC" v-model="equipment.ratio"
                    @change="onDataChanged">
                <option class="" v-for="(currentRatio, key) in this.orderedCurrentTransformer"
                        :value="currentRatio.id">{{ currentRatio.name }}
                </option>
            </select>
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.name + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="name" name="name" v-model.trim="equipment.name"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.number + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="number" name="number" v-model="equipment.number"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.production_date + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="number" id="production_date" name="production_date"
                   v-model.number="equipment.production_date"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.description + ':' }}</div>
            <textarea class="w-75 form-input form-text px-2 py-1 rounded" type="text" rows="3" id="description" name="description"
                      v-model.trim.lazy="equipment.description"
                      @input="onDataChanged"></textarea>
        </div>
        <div class="flex justify-end py-1">
            <input class="form-input w-32 ml-2 rounded disabled color-disabled"
                   v-bind:id="'btnSave_' + this.id"
                   type="button" @click="onSave"
                   :value="this.captions.btnSave">
            <input class="form-input w-32 ml-2 rounded disabled color-disabled"
                   v-bind:id="'btnReset_' + this.id"
                   type="button"
                   @click="onReset"
                   :value="this.captions.btnReset">
        </div>
    </div>
</template>

<script>
export default {
    name: "EquipmentDetail",
    props: {
        captions: {type: Object},
        equipment: {type: Object},
        equipmentTypes: {type: Array},
        voltageTransformer: {type: Array},
        voltageClass: {type: Array},
        currentTransformer: {type: Array},
        currentClass: {type: Array},
        token: {type: String},
    },
    mounted() {
        this._oldEquipment = this.equipment.constructor();
        this.copy(this.equipment, this._oldEquipment);
        this.check();
    },
    methods: {
        onSave(ev) {
            if (!this.dirty()) return;
            let self = this;
            let url = (this.equipment.id ?? 0) ? '/equipments/update/' + this.equipment.id : '/equipments/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                let obj = JSON.parse(result);
                self.copy(obj, self.equipment);
                self.copy(obj, self._oldEquipment);
                self.check();
            }
            this.$emit('data-changed', 'equipment', this.equipment, this.token, url, 'post', callback);
        },
        onReset(ev) {
            this.clear();
            let url = '/equipments/reset';
            this.$emit('data-reset', 'equipment', this.equipment.id ?? 0, this.token, url);
        },
        onDataChanged(ev) {
            this.check();
        },
        onAvatarChanged(newAvatar) {
            this.equipment.avatar = this.avatar = newAvatar;
            this.check();
        },
        check(ev) {
            let btnSave = '#btnSave_' + this.id;
            let btnReset = '#btnReset_' + this.id;
            if (!this.dirty()) {
                $(btnSave).removeClass('enabled').addClass('disabled');
                $(btnSave).addClass('color-disabled');
                $(btnReset).removeClass('enabled').addClass('disabled');
                $(btnReset).addClass('color-disabled');
            } else {
                $(btnSave).removeClass('disabled').addClass('enabled');
                $(btnSave).removeClass('color-disabled');
                $(btnReset).removeClass('disabled').addClass('enabled');
                $(btnReset).removeClass('color-disabled');
            }
            this.ratioShowHide();
        },
        ratioShowHide() {
            if (this.isVoltageTransformer()) {
                $('#VT').show();
                $('#CT').hide();
            } else if (this.isCurrentTransformer()) {
                $('#CT').show();
                $('#VT').hide();
            } else {
                $('#VT').hide();
                $('#CT').hide();
                this.equipment.ratio = 0;
            }
        },
        dirty(ev) {
            return !this.compare(this._oldEquipment, this.equipment);
        },
        clear() {
            this.copy(this._oldEquipment, this.equipment, true);
            this.check();
            this.avatar = this.equipment.avatar ?? '';
        },
        compare(obj1, obj2) {
            for (let prop in obj2) {
                if (obj1[prop] === undefined || obj1[prop] != obj2[prop]) return false;
            }
            return true;
        },
        copy(obj_from, obj_to, reset = false) {
            for (let property in obj_from) {
                obj_to[property] = obj_from[property];
                if (reset) $("#" + property).prop('value', obj_to[property]);
            }
        },
        isVoltageTransformer() {
            return this.equipment.equipment_type == 11;
        },
        isCurrentTransformer() {
            return this.equipment.equipment_type == 12;
        }
    },
    data() {
        return {
            _oldEquipment: {},
            avatar: this.equipment.avatar,
        }
    },
    computed: {
        id() {
            return this.equipment.id ? this.equipment.id + '' : 'New';
        },
        orderedEquipmentTypes() {
            return _.orderBy(this.equipmentTypes, ['order_index', 'id']);
        },
        orderedVoltageTransformer() {
            return _.orderBy(this.voltageTransformer, ['order_index', 'name']);
        },
        orderedVoltageClass() {
            return _.orderBy(this.voltageClass, ['order_index', 'name']);
        },
        orderedCurrentTransformer() {
            return _.orderBy(this.currentTransformer, ['order_index', 'name']);
        },
        orderedCurrentClass() {
            return _.orderBy(this.currentClass, ['order_index', 'name']);
        },
    }
}
</script>

<style scoped>
input[type=button] {
    margin-left: 1rem;
}

input.disabled {
    cursor: default;
}

input.enabled {
    color: #495057;
    cursor: pointer;
}
</style>
