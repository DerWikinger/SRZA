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
        modelId: {type: String},
        modelType: {type: String},
    },
    computed: {
        srcValue: function () {
            return '/storage/images/avatars/' + this.modelType + '/' + (this.modelId ?? 0) + '/' + (this.avatar ?? '');
        }
    }
}
</script>

<style scoped>

.avatar {
    display: inline-block;
    text-align: center;
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
