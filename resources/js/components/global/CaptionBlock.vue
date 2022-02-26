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
            // this.$alert(this.route);
            if (this.route) window.location = this.route;
        }
    }
}
</script>

<style scoped>

.outer-block {
    position: relative;
    width: 100%;
}

.outer-block * {
    display: inline-block;
}

.inner-block {
    position: relative;
    display: inline-block;
    float: right;
}

</style>
