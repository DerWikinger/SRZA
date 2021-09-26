<template>
    <div class="card form-group">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
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
                <slot name="role"></slot>
            </div>
            <input class="form-control col-4" type="button" @click="onClick" value="Save">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {type: Object},
        token: {type: String},
    },
    methods: {
        onClick(ev) {
            this.$emit('data-changed', this.user, this.token);
        },
        onNameChanged(ev) {

        },
        onEmailChanged(ev) {

        },
    }
}
</script>
