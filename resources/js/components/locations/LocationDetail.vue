<template>
    <div class="card form-group">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="id">ID:</label>
                <input class="form-control disabled" id="id" type="text" v-model="location.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="name">Name:</label>
                <input class="form-control " type="text" id="name" v-model.trim="location.name" @change="onNameChanged">
            </div>
            <input class="form-control col-4 disabled" v-bind:id="'btnSave_' + location.id" type="button" @click="onClick" value="Save">
        </div>
    </div>
</template>

<script>
export default {
    name: "LocationDetail",
    props: {
        location: {type: Object},
        token: {type: String},
    },
    created() {
        this._oldLocation = JSON.stringify(this.location);
    },
    methods: {
        onClick(ev) {
            this.$emit('data-changed', this.location, this.token);
        },
        onNameChanged(ev) {
            this.dirty(ev);
        },
        isClean() {
            return !this.dirty;
        },
        dirty(ev) {
            let elemId = '#btnSave_' + this.location.id;
            if(this._oldLocation === JSON.stringify(this.location)) {
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
