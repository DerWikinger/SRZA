<template>
    <a class="navbar-brand" :href="this.route">
        <slot></slot>
    </a>
</template>

<script>
export default {
    name: "AddButton",
    props: {
        route: {type: String},
    },
}
</script>

<style scoped>
a {
    border-radius: 0.25rem;
    border: #08b52c solid 1px;
    color: #08b52c;
    font-weight: bolder;
    padding: 0.25rem;
}
</style>
