<template>
    <div class="chat-info" @click="onClick">
        <user-avatar :id="this.chatUser.id + ''" :avatar="this.chatUser.avatar"></user-avatar>
        <div class="description">
            <div><strong>{{ chat.name ? chat.name : chatUser.name }}</strong></div>
            <div>{{ date }} : <input :max="maxLength" disabled readonly type="text" :value="message"></div>
        </div>
    </div>
</template>

<script>
import UserAvatar from "../users/UserAvatar";

export default {
    name: "chatsBrief",
    components: {UserAvatar},
    props: {
        user: {type: Object},
        chat: {type: Object},
        users: {type: Array},
        last: {type: Object}
    },
    methods: {
        onClick() {
            location = '/chat/' + this.chat.id;
        }
    },
    computed: {
        chatUser() {
            let result = null;
            for (let i = 0; i < this.users.length; i++) {
                let user = this.users[i];
                if (user.id !== this.user.id) {
                    result = user;
                    break;
                }
            }
            return result;
        },
        message() {
            let l = this.last.content.length;
            if (l > this.maxLength) {
                return this.last.content.substring(0, this.maxLength - 3) + '...';
            } else {
                return this.last.content;
            }
        },
        date() {
            let cr_dt = new Date(this.last.created_at);
            if (this.last.updated_at) {
                let up_dt = new Date(this.last.updated_at);
                if (up_dt > cr_dt) return up_dt.toDateString();
            }
            return cr_dt.toDateString();
        }
    },
    data() {
        return {
            maxLength: 30,
        }
    }
}
</script>

<style scoped>
.chat-info {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    cursor: pointer;
}

.chat-info input {
    font-style: italic;
    border: none;
    background: inherit;
    cursor: inherit;
}

div.user-avatar {
    display: inline-block;
    vertical-align: text-bottom;
}

.description {
    display: inline-block;
    margin-left: 1rem;
}
</style>
