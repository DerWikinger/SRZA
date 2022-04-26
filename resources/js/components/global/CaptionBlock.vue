<template>
    <div :class="'color-caption outer-block ' + ( this.align == 'center' ? 'text-center' : '' )">
        <h2 class="text-capitalize">{{ this.value }}</h2>
        <div class="inner-block">
            <return-button v-show="this.route" :route="this.route">
                <arrow-left></arrow-left>
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
    display: flex;
    justify-content: space-between;
}

.inner-block {
    display: flex;
    flex-direction: row-reverse;
}

</style>
