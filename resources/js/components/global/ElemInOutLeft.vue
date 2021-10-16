<template>
    <transition name="fade">
        <div v-if="show" class="inner-element">
            <slot class="inner-element" name="element"></slot>
        </div>
    </transition>
</template>

<script>
export default {
    name: "ElemInOutLeft",
    mounted() {
        this.show = true;
        setTimeout(() => {
            this.show = false;
        }, this.timeIn);
    },
    data() {
        return {
            show: false,
            timeIn: 1500,
            timeOut: 2000,
        }
    }
}
</script>

<style scoped>

.inner-element {
    position: relative;
    left: 0%;
}
.fade-enter-active {
    transition: left 1000ms ease-out;
}
.fade-leave-active {
    transition: left 1500ms ease-in;
}
.fade-enter {
    left: -100%;
}
.fade-enter-to {
    left: 0%;
}
.fade-leave {
    left: 0%;
}
.fade-leave-to {
    left: -100%;
}

</style>
