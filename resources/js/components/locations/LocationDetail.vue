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
        <div class="flex justify-between items-center">
            <div class="w-25 text-left font-bold">{{ this.captions.name + ':' }}</div>
            <input class="w-75 form-input form-text px-2 py-1 rounded" type="text" id="name" name="name"
                   v-model.trim="location.name"
                   @input="onDataChanged">
        </div>
        <div class="flex justify-between">
            <div class="w-25 text-left font-bold pt-2">{{ this.captions.description + ':' }}</div>
            <textarea class="w-75 form-input form-text px-2 py-1 rounded" type="text" rows="3" id="description"
                      name="description"
                      v-model.trim="location.description"
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
    name: "LocationDetail",
    props: {
        captions: {type: Object},
        location: {type: Object},
        token: {type: String},
    },
    created() {
        this._oldLocation = Object.assign({}, this.location);
    },
    methods: {
        onSave(ev) {
            if (!this.dirty()) return;
            let self = this;
            let url = (this.location.id ?? 0) ? '/locations/update/' + this.location.id : '/locations/store';
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                let obj = JSON.parse(result);
                console.log("New id: ", obj.id);
                console.log("Old id: ", self._oldLocation.id);
                if (obj.id) {
                    location = '/locations/edit/' + obj.id;
                } else {
                    console.log('Что-то пошло не так!');
                }
            }
            this.$emit('data-changed', 'location', this.location, this.token, url, 'post', callback);
        },
        onReset(ev) {
            if (!this.dirty()) return;
            this.clear();
            let url = '/locations/reset';
            this.$emit('data-reset', 'location', this.location.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            this.location.avatar = this.avatar = newAvatar;
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
            this.copy(this._oldLocation, this.location);
            this.avatar = this.location.avatar ?? '';
            for (let prop in this._oldLocation) {
                let elem = document.getElementById(prop);
                if (elem) elem.value = this._oldLocation[prop];
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
            return !this.compare(this.location, this._oldLocation);
        }
    },
    data() {
        return {
            _oldLocation: {},
            avatar: this.location.avatar,
        }
    },
    computed: {
        id() {
            return this.location.id ? this.location.id + '' : 'New';
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
