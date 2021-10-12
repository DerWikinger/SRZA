<template>
    <transition name="fade">
        <div v-if="show" class="inner-element">
            <slot class="inner-element" name="element"></slot>
        </div>
    </transition>
</template>

<script>
export default {
    name: "ElemOut",
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
}

.fade-enter-active {
    transition: opacity 1000ms ease-out;
}

.fade-leave-active {
    transition: opacity 2000ms ease;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}

</style>
