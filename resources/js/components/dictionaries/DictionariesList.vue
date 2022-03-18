<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="objects.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="list-item align-baseline " v-for="(object, key) in objects">
            <div class="row">
                <dictionary-brief class="col-8" :object="object"></dictionary-brief>
                <div class="offset-2 col-2 ">
                    <edit-delete-button-group
                        :id="object.id"
                        :token="token"
                        :base-route="'/dictionaries/' + dictionaryId"
                        :delete-permission="deletePermission">
                    </edit-delete-button-group>
                </div>
            </div>
        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import DictionaryBrief from "./DictionaryBrief";

export default {
    name: "DictionariesList",
    components: {DictionaryBrief},
    props: {
        objects: {type: Object},
        token: {type: String},
        dictionaryId: {type: String},
        deletePermission: {type: Number, default: 0},
    },
}
</script>

<style scoped>

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    padding-top: 0.25rem;
    font-size: 1.25rem;
}

</style>
