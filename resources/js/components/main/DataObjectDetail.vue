<template>
    <div class="flex justify-between flex-col text-center">
        <div class="w-full flex justify-center rounded mt-2 mb-4">
            <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="location"
                           id="changeAvatar" @value-changed="onAvatarChanged">
            </avatar-change>
        </div>
        <div class="flex justify-between items-center">
            <div class="w-25 text-left font-bold">{{ this.captions.id + ':' }}</div>
            <input class="w-75 disabled:opacity-75 form-input form-text px-2 py-1 rounded " id="id" name="id" type="text"
                   v-model="this.id" disabled>
        </div>
        <div v-if="~(this.fields.indexOf('number'))" class="flex justify-between items-center mt-1">
            <div class="w-25 text-left font-bold">{{ this.captions.number + ':' }}</div>
            <input class="w-75 form-input form-number px-2 py-1 rounded" type="number" id="number" name="number"
                   v-model="dataObject.number"
                   @input="onDataChanged">
        </div>
        <div v-if="~(this.fields.indexOf('name'))" class="flex justify-between items-center">
            <div class="w-25 text-left font-bold">{{ this.captions.name + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="name" name="name"
                   v-model.trim="dataObject.name"
                   @input="onDataChanged">
        </div>
        <div v-if="~(this.fields.indexOf('description'))" class="flex justify-between">
            <div class="w-25 text-left font-bold pt-2">{{ this.captions.description + ':' }}</div>
            <textarea class="w-75 form-input form-text px-2 py-1 rounded" type="text" rows="3" id="description"
                      name="description"
                      v-model.trim="dataObject.description"
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
    name: "DataObjectDetail",
    props: {
        captions: {type: Object},
        dataObject: {type: Object},
        dataType: { type: String},
        fields: {type: Array},
        token: {type: String},
    },
    created() {
        this._oldData = Object.assign({}, this.dataObject);
    },
    methods: {
        onSave(ev) {
            if (!this.dirty()) return;
            let self = this;
            let url = (this.dataObject.id ?? 0) ? '/' + this.dataType + 's/update/' + this.dataObject.id : '/' + this.dataType + 's/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                let obj = JSON.parse(result);
                console.log("New id: ", obj.id);
                console.log("Old id: ", self._oldData.id);
                if (obj.id) {
                    location = '/' + this.dataType + 's/edit/' + obj.id;
                } else {
                    console.log('Что-то пошло не так!');
                }
            }
            this.$emit('data-changed', this.dataType, this.dataObject, this.token, url, 'post', callback);
        },
        onReset(ev) {
            if (!this.dirty()) return;
            this.clear();
            let url = '/' + this.dataType + 's/reset';
            this.$emit('data-reset', this.dataType, this.dataObject.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            this.dataObject.avatar = this.avatar = newAvatar;
            this.check();
        },
        onDataChanged(ev) {
            this.check(ev);
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
        },
        clear() {
            this.copy(this._oldData, this.dataObject);
            this.avatar = this.dataObject.avatar ?? '';
            for (let prop in this._oldData) {
                let elem = document.getElementById(prop);
                if (elem) elem.value = this._oldData[prop];
            }
            this.check();
        },
        compare(obj1, obj2) {
            for (let prop in obj2) {
                console.log(prop, obj1[prop], obj2[prop]);
                if (obj1[prop] === undefined || obj1[prop] != obj2[prop]) return false;
            }
            return true;
        },
        copy(obj_from, obj_to) {
            for (let prop in obj_to) {
                obj_to[prop] = obj_from[prop];
            }
        },
        dirty() {
            return !this.compare(this.dataObject, this._oldData);
        }
    },
    data() {
        return {
            _oldData: {},
            avatar: this.dataObject.avatar,
        }
    },
    computed: {
        id() {
            return this.dataObject.id ? this.dataObject.id + '' : 'New';
        },
    }
}
</script>

<style scoped>

input.disabled {
    cursor: default;
}

input.enabled {
    color: #495057;
    cursor: pointer;
}
</style>
