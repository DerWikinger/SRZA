<template>
    <div>
        <div class="p-1" v-for="(user, key) in users">
            <user-brief :user="user"></user-brief>
        </div>
    </div>
</template>

<script>
import UserBrief from "./UserBrief";

export default {
    components: {UserBrief},
    props: {
        users: {type: Array},
    },
    created() {
    },
    methods: {
        onClick(key) {

        },
    },
    data() {
        return {

        }
    },
}
</script>

<style scoped>
</style>
