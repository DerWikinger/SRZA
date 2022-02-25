<template>
    <!--    <a class="navbar-brand" :href="this.route">-->
    <!--        <slot></slot>-->
    <!--    </a>-->
    <div class="btn-area">
        <div class="color-caption btn form-control text-center" @click="onClick" id="btn-reset">
            <slot></slot>
        </div>
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

#btn-reset {
    border-radius: 0.25rem;
    border: solid 1px;
    width: 100%;
    font-weight: bolder;
    padding: 0.25rem;
}

.btn-area {
    margin-right: 1rem;
}

</style>
