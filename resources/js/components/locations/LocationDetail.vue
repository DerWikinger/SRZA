<template>
    <div class="card form-group">
        <!--        <div class="card-header">-->
        <!--            <slot name="header"></slot>-->
        <!--        </div>-->
        <div class="card-body">
            <div class="form-group row">
                <div class="col-12 text-center">
                    <avatar-change :avatar="this.location.avatar" :id="this.id" :token="this.token" model="location">
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
                <textarea class="form-control " type="text" rows="3" id="description" name="description" v-model.trim="location.description"
                          @input="onDataChanged"></textarea>
            </div>
            <input class="form-control col-4 disabled" v-bind:id="'btnSave_' + this.id" type="button" @click="onClick"
                   :value="this.captions.btnSave + ':'">
            <!--            </form>-->
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
        this._oldLocation = JSON.stringify(this.location);
        console.log('Captions: ', this.captions);
    },
    methods: {
        onClick(ev) {
            this.$emit('data-changed', 'App\\Models\\Location', this.location, this.token, 'store');
        },
        onDataChanged(ev) {
            this.dirty(ev);
        },
        isClean() {
            return !this.dirty;
        },
        dirty(ev) {
            let elemId = '#btnSave_' + this.id;
            if (this._oldLocation === JSON.stringify(this.location)) {
                this._dirty = false;
                $(elemId).removeClass('enabled').addClass('disabled');
            } else {
                this._dirty = true;
                $(elemId).removeClass('disabled').addClass('enabled');
            }
        },
        clear() {
            this._dirty = false;
        }
    },
    data() {
        return {
            _dirty: false,
            _oldLocation: {},
        }
    },
    computed: {
        id() {
            return this.location.id ? this.location.id : 'New';
        }
    }
}
</script>

<style scoped>
input.disabled {
    color: gray;
    cursor: default;
}

input.enabled {
    color: black;
    cursor: pointer;
}
</style>
