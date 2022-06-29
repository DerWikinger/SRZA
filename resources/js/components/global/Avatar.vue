<template>
    <div class="wrapper flex justify-center">
        <div class="avatar flex justify-center items-center" >
            <img class="img-avatar" v-if="avatar != ''"
                 :src="srcValue" :alt="avatar">
            <img class="img-avatar" v-else
                 src="/storage/images/avatars/default_avatar.png" alt="default_avatar.png">
        </div>
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
    height: 2.5rem;
    width: 2.5rem;
}

.img-avatar {
    width: auto;
    height: 2.5rem;
    object-fit: fill;
    border-radius: 0rem 0.75rem 0.75rem 0.75rem;
    border: 1px solid #ced4da;
    overflow: hidden;
}

</style>
