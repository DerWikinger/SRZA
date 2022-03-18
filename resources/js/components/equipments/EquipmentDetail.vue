<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 text-center">
                    <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="equipment"
                                   id="changeAvatar" @value-changed="onAvatarChanged">
                    </avatar-change>
                </div>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="id">{{ this.captions.id + ':' }}</label>
                <input class="form-control disabled" id="id" name="id" type="text" v-model="this.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="equipment_type">{{
                        this.captions.equipment_type + ':'
                    }}</label>
                <select class="form-control " type="text" id="equipment_type" name="equipment_type"
                        v-model="equipment.equipment_type"
                        @change="onDataChanged">
                    <option class="" v-for="(equipmentType, key) in this.orderedEquipmentTypes" :value="equipmentType.id">
                        {{ equipmentType.name }}
                    </option>
                </select>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="mark">{{ this.captions.mark + ':' }}</label>
                <input class="form-control " type="text" id="mark" name="mark" v-model.trim="equipment.mark"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="model">{{ this.captions.model + ':' }}</label>
                <input class="form-control " type="text" id="model" name="model" v-model.trim="equipment.model"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="schema_label">{{ this.captions.schema_label + ':' }}</label>
                <input class="form-control " type="text" id="schema_label" name="schema_label"
                       v-model.trim.lazy="equipment.schema_label"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="voltage_class">{{
                    this.captions.voltage_class + ':'
                    }}</label>
                <select class="form-control " type="text" id="voltage_class" name="voltage_class"
                        v-model="equipment.voltage_class"
                        @change="onDataChanged">
                    <option class="" v-for="(voltageClass, key) in this.orderedVoltageClass" :value="voltageClass.id">
                        {{ voltageClass.name }}
                    </option>
                </select>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="current_class">{{
                        this.captions.current_class + ':'
                    }}</label>
                <select class="form-control " type="text" id="current_class" name="current_class"
                        v-model="equipment.current_class"
                        @change="onDataChanged">
                    <option class="" v-for="(currentClass, key) in this.orderedCurrentClass" :value="currentClass.id">
                        {{ currentClass.name }}
                    </option>
                </select>
            </div>
            <div class="input-group form-group" id="VT">
                <label class="col-form-label col-3" for="ratioV">{{ this.captions.ratio + ':' }}</label>
                <select class="form-control " type="text" id="ratioV" name="ratioV" v-model="equipment.ratio"
                        @change="onDataChanged">
                    <option class="" v-for="(voltageRatio, key) in this.orderedVoltageTransformer"
                            :value="voltageRatio.id">{{ voltageRatio.name }}
                    </option>
                </select>
            </div>
            <div class="input-group form-group" id="CT">
                <label class="col-form-label col-3" for="ratioC">{{ this.captions.ratio + ':' }}</label>
                <select class="form-control " type="text" id="ratioC" name="ratioC" v-model="equipment.ratio"
                        @change="onDataChanged">
                    <option class="" v-for="(currentRatio, key) in this.orderedCurrentTransformer"
                            :value="currentRatio.id">{{ currentRatio.name }}
                    </option>
                </select>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="name">{{ this.captions.name + ':' }}</label>
                <input class="form-control " type="text" id="name" name="name" v-model.trim="equipment.name"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="number">{{ this.captions.number + ':' }}</label>
                <input class="form-control " type="text" id="number" name="number" v-model="equipment.number"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="production_date">{{
                        this.captions.production_date + ':'
                    }}</label>
                <input class="form-control " type="number" id="production_date" name="production_date"
                       v-model.number="equipment.production_date"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="description">{{ this.captions.description + ':' }}</label>
                <textarea class="form-control " type="text" rows="3" id="description" name="description"
                          v-model.trim.lazy="equipment.description"
                          @input="onDataChanged"></textarea>
            </div>
            <input class="form-control col-3 d-inline-block float-right" v-bind:id="'btnReset_' + this.id" type="button"
                   @click="onReset"
                   :value="this.captions.btnReset">
            <input class="form-control col-3 disabled d-inline-block float-right color-disabled"
                   v-bind:id="'btnSave_' + this.id"
                   type="button" @click="onSave"
                   :value="this.captions.btnSave">
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
    created() {
        this._oldEquipment = this.equipment.constructor();
        this.copy(this.equipment, this._oldEquipment);
        console.log('Created, this.equipment => ', this.equipment);
        console.log('Created, this.oldEquipment => ', this._oldEquipment);
        console.log('Created, this.currentTransformer => ', this.currentTransformer);
    },
    mounted() {
        this.ratioShowHide();
    },
    methods: {
        onSave(ev) {
            if (this.isClean()) return;
            let self = this;
            let url = (this.equipment.id ?? 0) ? '/equipments/update/' + this.equipment.id : '/equipments/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                if (!self._oldEquipment.id && result.id) {
                    location = '/equipments/edit/' + result.id;
                } else {
                    self.copy(result, self._oldEquipment, true);
                    self.avatar = self.equipment.avatar = result.avatar;
                    self.dirty();
                }
            }
            this.$emit('data-changed', 'equipment', this.equipment, this.token, url, 'post', callback);
        },
        onReset(ev) {
            this.clear();
            let url = '/equipments/reset';
            this.$emit('data-reset', 'equipment', this.equipment.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            console.log('New avatar: ', newAvatar);
            this.equipment.avatar = this.avatar = newAvatar;
            console.log('Equipment: ', this.equipment);
            console.log('Compare: ', this.compare(this._oldEquipment, this.equipment));
            this.dirty();
        },
        onDataChanged(ev) {
            this.dirty(ev);
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
        isClean() {
            return !this._dirty;
        },
        dirty(ev) {
            let elemId = '#btnSave_' + this.id;
            console.log('Button: ', elemId);
            if (this.compare(this._oldEquipment, this.equipment)) {
                this._dirty = false;
                $(elemId).removeClass('enabled').addClass('disabled');
                $(elemId).addClass('color-disabled');
            } else {
                this._dirty = true;
                $(elemId).removeClass('disabled').addClass('enabled');
                $(elemId).removeClass('color-disabled');
            }
            this.ratioShowHide();
        },
        clear() {
            this.copy(this._oldEquipment, this.equipment, true);
            this.dirty();
            this.avatar = this.equipment.avatar ?? '';
        },
        compare(obj1, obj2) {
            let result = (obj1.avatar ?? '') == (obj2.avatar ?? '') &&
                (obj1.number ?? 0) == (obj2.number ?? 0) &&
                (obj1.production_date ?? 0) == (obj2.production_date ?? 0) &&
                (obj1.equipment_type ?? 0) == (obj2.equipment_type ?? 0) &&
                (obj1.name ?? '') == (obj2.name ?? '') &&
                (obj1.ratio ?? 0) == (obj2.ratio ?? 0) &&
                (obj1.voltage_class ?? 0) == (obj2.voltage_class ?? 0) &&
                (obj1.current_class ?? 0) == (obj2.current_class ?? 0) &&
                (obj1.mark ?? '') == (obj2.mark ?? '') &&
                (obj1.model ?? '') == (obj2.model ?? '') &&
                (obj1.schema_label ?? '') == (obj2.schema_label ?? '') &&
                (obj1.description ?? '') == (obj2.description ?? '');
            console.log(obj1.equipment_type, obj2.equipment_type);
            return result;
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
            _dirty: false,
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
