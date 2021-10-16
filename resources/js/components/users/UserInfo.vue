<template>
    <div class="card form-group">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
<!--            <span v-for="n in 5" v-bind:class="{ 'rating-active': check(n)}">&star;</span>-->
            <!--            <div v-if="_odd">Odd</div>-->
            <!--            <div v-else>Even</div>-->
<!--            <div>{{ depth + length + width + user.id }}</div>-->
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="id">ID:</label>
                <input class="form-control disabled" id="id" type="text" v-model="user.id" disabled>
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="name">Name:</label>
                <input class="form-control " type="text" id="name" v-model.trim="user.name" @change="onNameChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="email">Email:</label>
                <input class="form-control " type="email" id="email" v-model.trim="user.email" @change="onEmailChanged">
            </div>
            <div class="input-group form-group">
                <label class="col-form-label col-2" for="role">Role:</label>
                <select class="form-control" name="role" id="role" v-model="role.id" @change="onRoleChanged">
                    <option v-for="(role, key) in roles" v-bind:value="role.id">{{ role.name }}</option>
                </select>
            </div>
            <input class="form-control col-4 disabled" v-bind:id="'btnSave_' + user.id" type="button" @click="onClick" value="Save">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {type: Object},
        role: {type: Object},
        roles: {type: Array},
        token: {type: String},
        depth: {type: Number},
    },
    created() {
        // this._oldUser = this.user;
        // this._oldRole = this.role;
        this._oldUser = JSON.stringify(this.user);
        this._oldRole = JSON.stringify(this.role);
    },
    methods: {
        onClick(ev) {
            this.$emit('data-changed', this.user, this.token);
        },
        onNameChanged(ev) {
            this.dirty(ev);
        },
        onEmailChanged(ev) {
            this.dirty(ev);
        },
        onRoleChanged(ev) {
            this.dirty(ev);
            console.log('Role changed!', this.user.name, this.role.id);
        },
        check(n) {
            return n % 2;
        },
        isClean() {
            return !this.dirty;
        },
        dirty(ev) {
            let elemId = '#btnSave_' + this.user.id;
            // console.log(this._oldUser === JSON.stringify(this.user) && this._oldRole === JSON.stringify(this.role));
            if(this._oldUser === JSON.stringify(this.user) && this._oldRole === JSON.stringify(this.role)) {
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
            width: 20,
            length: 50,
            _dirty: false,
            _oldUser: {},
            _oldRole: {},
        }
    },
    computed: {
        _odd() {
            return (this.user.id + this.width) % 2;
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
