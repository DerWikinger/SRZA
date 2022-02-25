<template>
    <div class="avatar-change">
        <div class="outer-block">
            <input class="input-avatar custom-file-input"
                   accept="image/*"
                   name="avatar_image"
                   @change="onAvatarChanged"
                   type="file"
                   @input="onInput">
            <img id="avatar" class="image-avatar">
            <div class="inner-block" id="btnReset" @click="onReset">
                <i class="fas fa-cut"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {type: String},
        modelId: {type: String},
        modelType: {type: String},
        token: {type: String},
        confirmMessage: {type: String},
    },
    mounted() {
        console.log('Mounted!');
        this.setImage(this.srcValue, this.altValue);
    },
    watch: {
        'value': {
            handler: function () {
                console.log('Value watcher is called!');
                console.log('Value: ', this.value);
                console.log('srcValue: ', this.srcValue);

                this.setImage(this.srcValue, this.altValue);
            },
            deep: true,
            immediate: true,
        },
    },
    methods: {
        onInput(e) {
            // this.$emit('input', this.content);
        },
        setImage(name, alt) {
            $('#avatar').attr('src', name);
            $('#avatar').attr('alt', alt);
        },
        onReset() {
            if(this.$confirm(this.confirmMessage ?? 'Are you sure? \n Do you want to delete this avatar image?')) {
                this.$emit('value-changed', '');
            }
        },
        onAvatarChanged(ev) {
            let fd = new FormData();
            let self = this;
            fd.append('avatar', $('input[name=avatar_image]')[0].files[0]);
            fd.append('id', this.modelId);
            fd.append('model', this.modelType);
            fd.append('_token', this.token);
            $.ajax({
                url: 'avatar-change',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    let path = response.path;
                    let filename = response.filename;
                    self.$emit('value-changed', filename);
                    console.log('Success');
                    console.log('Saved file: ', filename);
                },
                error: function (response) {
                    console.log('Failure', response);
                }
            });
        },
    },
    data() {
        return {
            _altValue: '',
            content: this.value,
        }
    },
    computed: {
        srcValue: function () {
            if (this.value) {
                return '/storage/images/avatars/' +
                    this.modelType + '/' +
                    (+this.modelId ? this.modelId : 0) + '/' +
                    this.value;
            } else {
                return '/storage/images/avatars/default_avatar.png';
            }
        },
        altValue: function () {
            if (this.value) return this.value;
            return 'default_avatar.png';
        }
    }
}
</script>

<style scoped>
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

.avatar-change {
    position: relative;
    align-content: center;
    display: inline-block;
}

#btnReset {
    position: absolute;
    top: 0;
    right: -1rem;
    width: 1rem;
    height: 1rem;
    opacity: 0.1;
    cursor: pointer;
}

#btnReset:hover {
    opacity: 1;
}

.outer-block {
    width: fit-content;
    left: 30%;
}

</style>
