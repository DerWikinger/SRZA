<template>
    <div class="is-clearfix">
        <div class="notification is-info is-pulled-left">
            <small>Sent by {{ user }}</small><br />
            {{ message }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Message",
    props: [
        'message',
        'user'
    ]
}
</script>

<style scoped>
.notification {
    max-width: 80%;
    margin-bottom: 1em;
}
small {
    color: #ccc;
    font-size: 0.65em;
}
</style>

