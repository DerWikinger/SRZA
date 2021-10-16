<template>
    <button type="reset" class="btn btn-primary" @click="profileReset">
        <slot class="inner-element"></slot>
    </button>
</template>

<script>
export default {
    name: "ButtonCancel",
    props: {
        id: {type: String},
        token: {type: String},
    },
    methods: {
        profileReset() {
            let fd = new FormData();
            fd.append('_token', this.token);
            $.ajax({
                url: '/profile/reset',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function () { }
            }).then(() => {
                location = '/cabinet/' + this.id;
                }
            );
        }
    }
}
</script>

<style scoped>

</style>
