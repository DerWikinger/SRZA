<template>
    <div>
        <div class="form-control-plaintext border-top" @click="show = !show">
            <span>ID: {{ user.id }} &nbsp; {{ user.email }}</span>
        </div>
        <div class="user-brief">
            <transition name="fade" mode="out-in">
                <div v-if="show"  @click="show = !show">
                    <div class="input-group form-group">
                        <label class="col-form-label col-2" for="name">Name:</label>
                        <input class="form-control " type="text" id="name" v-model="user.name" readonly>
                    </div>
                    <div class="input-group form-group">
                        <label class="col-form-label col-2" for="role">Role:</label>
                        <input class="form-control " type="text" id="role" v-model="user.role.name" readonly>
                    </div>
                    <div class="input-group form-group">
                        <label class="col-form-label col-2" for="verified">Verified:</label>
                        <input class="form-control-sm" type="checkbox" id="verified" :checked="user.verified" readonly>
                    </div>
                    <div class="input-group form-group">
                        <label class="col-form-label col-2" for="nickname">Nickname:</label>
                        <input class="form-control " type="text" id="nickname" v-model="user.nickname" readonly>
                    </div>
                    <div class="input-group form-group">
                        <label class="col-form-label col-2" for="created">Created at:</label>
                        <input class="form-control " type="text" id="created" v-model="user.createdAt" readonly>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {type: Object},
        // role: {type: Object},
    },
    created() {
    },
    methods: {
        onClick(ev) {
            // this.$emit('data-changed', this.user, this.token);
        },
        focusOut() {
            this.show = false;
        }
    },
    data() {
        return {
            show: false,
        }
    },
}
</script>

<style scoped>

.user-brief {
    outline: transparent;
    overflow: hidden;
}

.fade-enter-active {
    animation: fade-in 0.5s;
}

.fade-leave-active {
    animation: fade-in 0.5s reverse;
}

@keyframes fade-in {
    0% {
        transform: translateY(-100%);
        opacity: 1;
    }
    100% {
        transform: translateY(0px);
        opacity: 1;
    }
}

</style>
