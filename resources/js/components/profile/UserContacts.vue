<template>
    <div>
        <div v-if="contacts.length > 0" class="p-1" v-for="(contact, key) in contacts">
            <div class="contact-info" @click="onClick(contact.id)">
                <user-avatar :id="contact.id + ''" :avatar="contact.avatar ? contact.avatar : ''"></user-avatar>
                <div class="description">
                    <div><span><strong>{{ nickname ? contact.nickname : contact.name }}</strong></span></div>
                    <div><span>{{ email ? contact.email : ''}}</span></div>
                </div>
            </div>
        </div>
        <div v-if="contacts.length == 0">
            <div>You don't have any contacts!</div>
        </div>
    </div>
</template>

<script>
import UserAvatar from "../users/UserAvatar";

export default {
    name: "UserContacts",
    components: {UserAvatar},
    props: {
        id: {type: Boolean},
        email: {type: Boolean},
        nickname: {type: Boolean},
        contacts: {type: Array}
    },
    methods: {
        onClick(id) {
            console.log('Click on contact: ' + id);
        },
    },
    computed: {}
}
</script>

<style scoped>
img.avatar-image {

}

.contact-info {
    cursor: pointer;
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
}

.user-avatar {
    display: inline-block;
    vertical-align: text-bottom;
}

.description {
    display: inline-block;
    margin-left: 1rem;
}
</style>
