<template>
    <div class="avatar-change" >
        <input class="input-avatar custom-file-input"
               accept="image/*"
               name="avatar_image"
               @change="onAvatarChanged"
               type="file">
        <img id="avatar" class="image-avatar" v-if="avatar != ''"
             :src="srcValue" :alt="avatar">
        <img id="avatar" class="image-avatar" v-else
             src="/storage/images/avatars/default_avatar.png" alt="default_avatar.png">
    </div>
</template>

<script>
export default {
    props: {
        avatar: {type: String},
        id: {type: String},
        model: {type: String},
        token: {type: String},
    },
    created() {
    },
    methods: {
        onAvatarChanged(ev) {
            let fd = new FormData();
            let self = this;
            fd.append('avatar', $('input[name=avatar_image]')[0].files[0]);
            fd.append('id', this.id);
            fd.append('model', this.model);
            fd.append('_token', this.token);
            $.ajax({
                url: 'avatar-change',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    let path = response.path;
                    let filename = response.filename;
                    $('#avatar').attr('src', path + '/' + filename);
                    $('#avatar').attr('alt', filename);
                    console.log('Success');
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
            return '/storage/images/avatars/' + this.model + '/' + this.id + '/' + this.avatar;
        }
    }
}
</script>

<style scoped>
.user-avatar {
    display: inline-block;
}

input.input-avatar {
    position: absolute;
    width: 130px;
    height: 130px;
    cursor: pointer;
}

img#avatar {
    width: 130px;
    height: 130px;
    border: #ced4da solid 1px;
    border-radius: 1.25rem;
    overflow: hidden;
}

</style>
