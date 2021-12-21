<template>
    <div class="chat-panel container">
        <div class="chat-box row">
            <div class="col-12">
                <p v-if="!messages.length">Start typing the first message</p>
                <div v-for="message in messages">
                    <my-message
                        v-if="message.user == userId"
                        :message="message.text"
                    ></my-message>
                    <message
                        v-if="message.user != userId"
                        :message="message.text"
                        :user="message.user"
                    ></message>
                </div>
            </div>
        </div>
        <div class="chat-input row">
            <form @submit.prevent="submit" class="form-inline">
                <!--                <div class="field has-addons has-addons-fullwidth">-->
                <div class="control col-11 ctrl-input">
                    <input class="input" type="text" placeholder="Type a message" v-model="newMessage">
                </div>
                <div class="control col-1 ctrl-btn">
                    <button type="submit" class="button is-danger" :disabled="!newMessage">
                        Send
                    </button>
                </div>
                <!--                </div>-->
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        userId: {type: String},
        token: {type: String},
        chatId: {type: String},
    },
    data() {
        return {
            messages: [],
            newMessage: ''
        }
    },
    mounted() {
        let self = this;
        $.ajax({
            url: '/chats/' + _.trim(self.chatId) + '/messages',
            type: 'GET',
            processData: false,
            contentType: false,
            async: false,
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    let message = data[i];
                    self.messages.push({
                        text: message.text,
                        user: message.userId
                    });
                }
            },
            error: function (response) {
                console.log('Failure: ', response.statusText);
            },
        });
        let channel = Echo.private('chat.' + this.chatId);
        // console.log(channel);
        channel.listen('NewChatMessage', (e) => {
            if (e.user != self.userId) {
                self.messages.push({
                    text: e.message,
                    user: e.user
                });
                console.log('I`ve received new message!');
            } else {
                console.log('I`ve received my message!');
            }
        });
    },
    methods: {
        submit() {
            let fd = new FormData();
            let self = this;
            fd.append('user', this.userId);
            fd.append('chat', this.chatId);
            fd.append('message', this.newMessage);
            fd.append('_token', this.token);
            $.ajax({
                url: '/chats/' + _.trim(self.chatId) + '/message',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function (response) {
                    self.messages.push({
                        text: self.newMessage,
                        user: self.userId
                    });
                    self.newMessage = '';
                    console.log('Message has been sent');
                    console.log(self.token);
                },
                error: function (response) {
                    console.log('Failure: ', response.statusText);
                },
            });
        }
    }
}
</script>
<style scoped>

.chat-panel {
    position: relative;
    height: 100%;
}

.chat-box, .chat-input {
    margin: 1rem 0rem;
    padding: 1rem 0rem;
    background: white;
    border-radius: 1rem;
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.chat-input .ctrl-btn {
    min-width: 5rem;
}

.chat-input .control * {
    width: 100%;
    border-radius: 0.25rem;
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.chat-input form {
    display: contents;
}

.chat-input .ctrl-input {
    padding-right: 0;
}

.control button {
    /*min-width: 3rem;*/
}

</style>
