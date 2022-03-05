<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 text-center">
                    <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="cell"
                                   id="changeAvatar" @value-changed="onAvatarChanged">
                    </avatar-change>
                </div>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="id">{{ this.captions.id + ':' }}</label>
                <input class="form-control disabled" id="id" name="id" type="text" v-model="this.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="number">{{ this.captions.number + ':' }}</label>
                <input class="form-control " type="number" id="number" name="number" v-model="cell.number"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="name">{{ this.captions.name + ':' }}</label>
                <input class="form-control " type="text" id="name" name="name" v-model.trim="cell.name"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-3" for="description">{{ this.captions.description + ':' }}</label>
                <textarea class="form-control " type="text" rows="3" id="description" name="description"
                          v-model.trim="cell.description"
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
    name: "CellDetail",
    props: {
        captions: {type: Object},
        cell: {type: Object},
        token: {type: String},
    },
    created() {
        this._oldCell = this.cell.constructor();
        this.copy(this.cell, this._oldCell);
        console.log('Created, this.cell => ', this.cell);
    },
    methods: {
        onSave(ev) {
            if (this.isClean()) return;
            let self = this;
            let url = (this.cell.id ?? 0) ? '/cells/update/' + this.cell.id : '/cells/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                if(!self._oldCell.id && result.id) {
                    location = '/cells/edit/' + result.id;
                } else {
                    console.log('Before copy');
                    console.log('Saved avatar: ', result.avatar);
                    console.log('This cell.avatar: ', self.cell.avatar);
                    console.log('This avatar: ', self.avatar);
                    self.copy(result, self._oldCell, true);
                    self.avatar = self.cell.avatar = result.avatar;
                    self.dirty();
                    console.log('After copy');
                    console.log('Saved avatar: ', result.avatar);
                    console.log('This cell.avatar: ', self.cell.avatar);
                    console.log('This avatar: ', self.avatar);
                }
            }
            console.log('This.cell => ', this.cell);
            this.$emit('data-changed', 'cell', this.cell, this.token, url, 'post', callback);
        },
        onReset(ev) {
            this.clear();
            let url = '/cells/reset';
            this.$emit('data-reset', 'cell', this.cell.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            console.log('New avatar: ', newAvatar);
            this.cell.avatar = this.avatar = newAvatar;
            console.log('Cell: ', this.cell);
            console.log('Compare: ', this.compare(this._oldCell, this.cell));
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
            if (this.compare(this._oldCell, this.cell)) {
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
            this.copy(this._oldCell, this.cell, true);
            this.dirty();
            this.avatar = this.cell.avatar ?? '';
        },
        compare(obj1, obj2) {
            // for (let prop in obj1) {
            //     if (obj1[prop] != obj2[prop]) return false;
            // }
            return obj1.avatar == obj2.avatar &&
                obj1.number == obj2.number &&
                obj1.name == obj2.name &&
                obj1.description == obj2.description;
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
            _oldCell: {},
            avatar: this.cell.avatar,
        }
    },
    computed: {
        id() {
            return this.cell.id ? this.cell.id + '' : 'New';
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
