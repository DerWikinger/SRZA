<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="flex justify-between border-b border-gray-300 py-1 align-baseline " v-for="(dataObject, key) in dataObjects">
            <data-object-brief class="w-4/5" :data-object="dataObject" :data-type="dataType"></data-object-brief>
            <div class="w-1/5">
                <edit-delete-button-group
                    :id="dataObject.id"
                    :token="token"
                    :base-route="'/' + dataType + 's'"
                    :delete-permission="+deletePermission">
                </edit-delete-button-group>
            </div>

        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import DataObjectBrief from "../main/DataObjectBrief";

export default {
    name: "DataObjectsList",
    components: {DataObjectBrief},
    props: {
        dataObjects: {type: Array},
        dataType: {type: String},
        token: {type: String},
        deletePermission: {type: String, default: '0'},
    },
}
</script>

<style scoped>


</style>
