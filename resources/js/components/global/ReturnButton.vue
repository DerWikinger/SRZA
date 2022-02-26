<template>
        <div @click="onClick" class="btn-area">
            <slot></slot>
        </div>
</template>

<script>
export default {
    name: "ReturnButton",
    props: {
        route: {type: String},
    },
    methods: {
        onClick() {
            // this.$alert(this.route);
            if(this.route) window.location = this.route;
        }
    }
}
</script>

<style scoped>

.btn-area {
    cursor: pointer;
}

</style>
