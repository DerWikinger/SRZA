<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 text-center">
                    <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="unit"
                                   id="changeAvatar" @value-changed="onAvatarChanged">
                    </avatar-change>
                </div>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="id">{{ this.captions.id + ':' }}</label>
                <input class="form-control disabled" id="id" name="id" type="text" v-model="this.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="name">{{ this.captions.name + ':' }}</label>
                <input class="form-control " type="text" id="name" name="name" v-model.trim="unit.name"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="description">{{ this.captions.description + ':' }}</label>
                <textarea class="form-control " type="text" rows="3" id="description" name="description"
                          v-model.trim="unit.description"
                          @input="onDataChanged"></textarea>
            </div>
            <input class="form-control col-3 d-inline-block float-right" v-bind:id="'btnReset_' + this.id" type="button"
                   @click="onReset"
                   :value="this.captions.btnReset">
            <input class="form-control col-3 disabled d-inline-block float-right color-disabled" v-bind:id="'btnSave_' + this.id"
                   type="button" @click="onSave"
                   :value="this.captions.btnSave">
        </div>
    </div>
</template>

<script>
export default {
    name: "UnitDetail",
    props: {
        captions: {type: Object},
        unit: {type: Object},
        token: {type: String},
    },
    created() {
        this._oldUnit = this.unit.constructor();
        this.copy(this.unit, this._oldUnit);
        console.log('Created, this.unit => ', this.unit);
    },
    methods: {
        onSave(ev) {
            if (this.isClean()) return;
            let self = this;
            let url = (this.unit.id ?? 0) ? '/units/update/' + this.unit.id : '/units/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                if(!self._oldUnit.id && result.id) {
                    location = '/units/edit/' + result.id;
                } else {
                    console.log('Before copy');
                    console.log('Saved avatar: ', result.avatar);
                    console.log('This unit.avatar: ', self.unit.avatar);
                    console.log('This avatar: ', self.avatar);
                    self.copy(result, self._oldUnit, true);
                    self.avatar = self.unit.avatar = result.avatar;
                    self.dirty();
                    console.log('After copy');
                    console.log('Saved avatar: ', result.avatar);
                    console.log('This unit.avatar: ', self.unit.avatar);
                    console.log('This avatar: ', self.avatar);
                }
            }
            console.log('This.unit => ', this.unit);
            this.$emit('data-changed', 'unit', this.unit, this.token, url, 'post', callback);
        },
        onReset(ev) {
            this.clear();
            let url = '/units/reset';
            this.$emit('data-reset', 'unit', this.unit.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            console.log('New avatar: ', newAvatar);
            this.unit.avatar = this.avatar = newAvatar;
            console.log('Unit: ', this.unit);
            console.log('Compare: ', this.compare(this._oldUnit, this.unit));
            this.dirty();
        },
        onDataChanged(ev) {
            this.dirty(ev);
        },
        isClean() {
            return !this._dirty;
        },
        dirty(ev) {
            let elemId = '#btnSave_' + this.id;
            console.log('Button: ', elemId);
            if (this.compare(this._oldUnit, this.unit)) {
                this._dirty = false;
                $(elemId).removeClass('enabled').addClass('disabled');
                $(elemId).addClass('color-disabled');
            } else {
                this._dirty = true;
                $(elemId).removeClass('disabled').addClass('enabled');
                $(elemId).removeClass('color-disabled');
            }
        },
        clear() {
            this.copy(this._oldUnit, this.unit, true);
            this.dirty();
            this.avatar = this.unit.avatar ?? '';
        },
        compare(obj1, obj2) {
            for (let prop in obj1) {
                if (obj1[prop] != obj2[prop]) return false;
            }
            return true;
        },
        copy(obj_from, obj_to, reset = false) {
            for (let property in obj_from) {
                obj_to[property] = obj_from[property] ?? '';
                if (reset) $("#" + property).prop('value', obj_to[property]);
            }
        }
    },
    data() {
        return {
            _dirty: false,
            _oldUnit: {},
            avatar: this.unit.avatar,
        }
    },
    computed: {
        id() {
            return this.unit.id ? this.unit.id + '' : 'New';
        }
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
