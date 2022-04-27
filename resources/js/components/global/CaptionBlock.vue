<template>
    <div :class="'color-caption outer-block ' + ( this.align == 'center' ? 'text-center' : '' )">
        <h2 class="text-capitalize w-full text-center w-100">{{ this.value }}</h2>
        <div class="inner-block w-10">
            <return-button class="" v-show="this.route" :route="this.route">
                <arrow-left class=""></arrow-left>
            </return-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CaptionBlock",
    props: {
        value: {type: String},
        route: {type: String},
        align: {type: String},
    },
    methods: {
        onClick() {
            if (this.route) window.location = this.route;
        }
    }
}
</script>

<style scoped>

.outer-block {
    width: 100%;
    display: block;
    position: relative;
}

.inner-block {
    display: flex;
    flex-direction: row-reverse;
    position: absolute;
    right: 0;
    top: 0;
}

</style>
