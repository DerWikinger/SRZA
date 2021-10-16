<template>
    <div class="user-avatar-change" >
        <input class="input-avatar custom-file-input"
               accept="image/*"
               name="avatar_image"
               @change="onAvatarChanged"
               type="file">
        <img id="avatar" class="img-avatar" v-if="avatar != ''"
             :src="srcValue" :alt="avatar">
        <img id="avatar" class="img-avatar" v-else
             src="/storage/images/avatars/default_avatar.jpg" alt="default_avatar.jpg">
    </div>
</template>

<script>
export default {
    props: {
        avatar: {type: String},
        id: {type: String},
        token: {type: String},
    },
    created() {
    },
    methods: {
        onAvatarChanged(ev) {
            console.log('Avatar image is upload');
            let fd = new FormData();
            fd.append('avatar', $('input[name=avatar_image]')[0].files[0]);
            fd.append('userId', this.id);
            fd.append('_token', this.token);
            $.ajax({
                url: '/profile/upload',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    let path = response.path;
                    let filename = response.filename;
                    $('#avatar').attr('src', path + '/' + filename);
                    $('#avatar').attr('alt', filename);
                },
                error: function (response) {
                    console.log('Failure', response);
                }
            });
        },
    },
    data() {
        return {}
    },
    computed: {
        srcValue: function () {
            return '/storage/images/avatars/' + this.id + '/' + this.avatar;
        }
    }
}
</script>

<style scoped>
.user-avatar {
    display: inline-block;
}

.input-avatar {
    position: absolute;
    width: 130px;
    height: 130px;
    cursor: pointer;
}

.img-avatar {
    width: 130px;
    height: 130px;
    border: #ced4da solid 1px;
    border-radius: 1.25rem;
}

</style>
