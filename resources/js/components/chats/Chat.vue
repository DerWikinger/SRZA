<template>
    <div>
        <div class="box">
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

        <form @submit.prevent="submit">
            <div class="field has-addons has-addons-fullwidth">
                <div class="control is-expanded">
                    <input class="input" type="text" placeholder="Type a message" v-model="newMessage">
                </div>
                <div class="control">
                    <button type="submit" class="button is-danger" :disabled="!newMessage">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        userId: {type: String},
        token: {type: String}
    },
    data() {
        return {
            messages: [],
            newMessage: ''
        }
    },
    mounted() {
        let self = this;
        let channel = Echo.private('chat.' + 1);
        console.log(channel);
        console.log(Echo);
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
            fd.append('message', this.newMessage);
            fd.append('_token', this.token);
            $.ajax({
                url: '/chat/message',
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
