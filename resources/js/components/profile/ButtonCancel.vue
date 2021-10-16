<template>
    <button type="reset" class="btn btn-primary" @click="profileReset">
        <slot class="inner-element"></slot>
    </button>
</template>

<script>
export default {
    name: "ButtonCancel",
    props: {
      id: { type: String},
    },
    methods: {
        profileReset() {
            $.ajax('/profile/reset/' + this.id).then(() => {
                location = '/cabinet/' + this.id;
            })
        }
    }
}
</script>

<style scoped>

</style>
