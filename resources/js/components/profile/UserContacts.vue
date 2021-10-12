<template>
    <div>
        <div v-if="contacts.length > 0" class="p-1" v-for="(contact, key) in contacts">
            <div class="contact-info" @click="onClick(contact.id)">
                <img v-if="contact.avatar" class="avatar-image" :src=" '/storage/images/avatars/' + contact.id + '/' + contact.avatar">
                <img v-else class="avatar-image" src="/storage/images/avatars/default_avatar.jpg">
                <span>{{ nickname ? contact.nickname : contact.name }}</span>
                <span>{{ email ? ': ' + contact.email : ''}}</span>
            </div>
        </div>
        <div v-if="contacts.length == 0">
            <div>You don't have any contacts!</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserContacts",
    props: {
        id: { type: Boolean },
        email: { type: Boolean },
        nickname: { type: Boolean },
        contacts: { type: Array }
    },
    methods: {
        onClick(id) {
            console.log('Click on contact: ' + id);
        },
    },
    computed: {
    }
}
</script>

<style scoped>
img.avatar-image {
    height: 30px;
    vertical-align: center;
    padding: 2px;
    border-radius: 15px;
    border: 1px solid #ced4da;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.contact-info {
    cursor: pointer;
}
</style>
