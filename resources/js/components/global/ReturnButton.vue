<template>
        <div @click="onClick" class="hover:cursor-pointer flex items-center pt-2">
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
            if(this.route) window.location = this.route;
        }
    }
}
</script>

<style scoped>

</style>
