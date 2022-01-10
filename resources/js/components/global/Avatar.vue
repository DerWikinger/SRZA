<template>
    <div class="avatar">
        <img class="img-avatar" v-if="avatar != ''"
             :src="srcValue" :alt="avatar">
        <img class="img-avatar" v-else
             src="/storage/images/avatars/default_avatar.png" alt="default_avatar.png">
    </div>
</template>

<script>
export default {
    name: "Avatar",
    props: {
        avatar: {type: String},
        id: {type: String},
        model: {type: String},
    },
    computed: {
        srcValue: function () {
            return '/storage/images/avatars/' + this.model + '/' + (this.id ?? 0) + '/' + (this.avatar ?? '');
        }
    }
}
</script>

<style scoped>

.avatar {
    display: inline-block;
}

.img-avatar {
    height: 2.5rem;
    vertical-align: middle;
    padding: 0rem;
    border-radius: 0rem 0.75rem 0.75rem 0.75rem;
    border: 1px solid #ced4da;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    overflow: hidden;
}

</style>
