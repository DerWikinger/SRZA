<template>
    <div class="card">
        <div class="card-header">
            <slot name="header"></slot>
        </div>
        <div class="card-body">
            <div>ID: {{ user.id }}</div>
            <label for="name">Name: </label>
            <input type="text" id="name" v-model.trim="user.name" @change="onNameChanged">
<!--            <div>-->
<!--                Name: {{ user.name }}-->
<!--            </div>-->
            <div>
                Email: {{ user.email }}
            </div>
            <slot name="role"></slot>
            <input type="button" @click="onClick" value="Click me!">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {type: Object},
    },
    methods: {
        onClick(ev) {
            // console.log(ev);
            // let oldValue = this.user.name;
            // this.user.name = 'New name';
            //console.log(this.user);
        },
        onNameChanged(ev) {
            // this.user.save();
            this.$emit('data-changed', this.user);
            // console.log(this.user.name);
        }
    }
}
</script>
