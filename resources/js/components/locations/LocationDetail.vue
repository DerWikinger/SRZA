<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 text-center">
                    <avatar-change v-model="avatar" :model-id="this.id" :token="this.token" model-type="location"
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
                <input class="form-control " type="text" id="name" name="name" v-model.trim="location.name"
                       @input="onDataChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="description">{{ this.captions.description + ':' }}</label>
                <textarea class="form-control " type="text" rows="3" id="description" name="description"
                          v-model.trim="location.description"
                          @input="onDataChanged"></textarea>
            </div>
            <input class="form-control col-3 d-inline-block float-right" v-bind:id="'btnReset_' + this.id" type="button"
                   @click="onReset"
                   :value="this.captions.btnReset">
            <input class="form-control col-3 disabled d-inline-block float-right" v-bind:id="'btnSave_' + this.id"
                   type="button" @click="onSave"
                   :value="this.captions.btnSave">
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
        this._oldLocation = this.location.constructor();
        this.copy(this.location, this._oldLocation);
    },
    methods: {
        onSave(ev) {
            if(this.isClean()) return;
            let url = (this.location.id ?? 0) ? 'update' : 'store';
            this.$emit('data-changed', 'location', this.location, this.token, url);
        },
        onReset(ev) {
            this.clear();
            let url = '/locations/reset';
            this.$emit('data-reset', 'location', this.location.id ?? 0, this.token, url);
        },
        onAvatarChanged(newAvatar) {
            console.log('New avatar: ', newAvatar);
            this.location.avatar = this.avatar = newAvatar;
            console.log('Location: ', this.location);
            console.log('Compare: ', this.compare(this._oldLocation, this.location));
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
            if (this.compare(this._oldLocation, this.location)) {
                this._dirty = false;
                $(elemId).removeClass('enabled').addClass('disabled');
            } else {
                this._dirty = true;
                $(elemId).removeClass('disabled').addClass('enabled');
            }
        },
        clear() {
            this.copy(this._oldLocation, this.location, true);
            this.dirty();
            this.avatar = this.location.avatar ?? '';
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
            _oldLocation: {},
            avatar: this.location.avatar,
        }
    },
    computed: {
        id() {
            return this.location.id ? this.location.id + '' : 'New';
        }
    }
}
</script>

<style scoped>
input[type=button] {
    margin-left: 1rem;
}

input.disabled {
    color: gray;
    cursor: default;
}

input.enabled {
    color: #495057;
    cursor: pointer;
}
</style>
