<template>
    <div>
        <div class="p-1" v-for="(contact, key) in contacts">
            <user-brief :user="contact"></user-brief>
        </div>
    </div>
</template>

<script>
import UserBrief from "../users/UserBrief";
export default {
    name: "UserContacts",
    components: {UserBrief},
    props: {
        contacts: { type: Array }
    },
    computed: {
        // contacts() {
        //     return this.user.contacts;
        // }
    }
}
</script>

<style scoped>

</style>
