<template>
    <div class="" @click="onClick">
        <div class="description col-10 ">
            <strong>{{ this.object.name }}</strong>
        </div>
    </div>
</template>

<script>

export default {
    name: "DictionaryBrief",
    props: {
        object: {type: Object},
    },
    methods: {
        onClick() {
            // let showPath = '/dictionaries/' + this.object.id;
            // window.location = showPath;
        },
    },
}
</script>

<style scoped>

.location-info .row div {
    cursor: pointer;
    display: inline-block;
}

.description {

}

/*.location-info div {*/
/*    display: inline-block;*/
/*    !*margin: 0 1rem;*!*/
/*}*/

</style>
