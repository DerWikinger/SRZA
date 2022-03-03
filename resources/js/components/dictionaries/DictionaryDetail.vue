<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="id">{{ this.captions.id + ':' }}</label>
                <input class="form-control disabled" id="id" name="id" type="text" v-model="this.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="name">{{ this.captions.name + ':' }}</label>
                <input class="form-control " type="text" id="name" name="name" v-model.trim="object.name"
                       @input="onDataChanged">
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
    name: "DictionaryDetail",
    props: {
        captions: {type: Object},
        object: {type: Object},
        token: {type: String},
        dictionaryId: {type: String},
    },
    created() {
        this._oldObject = this.object.constructor();
        this.copy(this.object, this._oldObject);
        console.log('Created, this.object => ', this.object);
    },
    methods: {
        onSave(ev) {
            if (this.isClean()) return;
            let self = this;
            let url = '/dictionaries/' + this.dictionaryId + ((this.object.id ?? 0) ?  '/update' : '/store');
            let callback = function (result) {
                self.$alert('Данные успешно сохранены!');
                if(!self._oldObject.id && result.id) {
                    location = '/dictionaries/' + self.dictionaryId + '/edit/' + result.id;
                } else {
                    self.copy(result, self._oldObject, true);
                    self.dirty();
                }
            }
            console.log('This.object => ', this.object);
            this.$emit('data-changed', 'object', this.object, this.token, url, 'post', callback);
        },
        onReset(ev) {
            this.clear();
            let url = 'reset';
            this.$emit('data-reset', 'unit', this.object.id ?? 0, this.token, url);
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
            if (this.compare(this._oldObject, this.object)) {
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
            this.copy(this._oldObject, this.object, true);
            this.dirty();
        },
        compare(obj1, obj2) {
            return obj1.name == obj2.name;
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
            _oldObject: {},
        }
    },
    computed: {
        id() {
            return this.object.id ? this.object.id + '' : 'New';
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
