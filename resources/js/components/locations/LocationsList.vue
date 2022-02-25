<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="list-item align-baseline " v-for="(location, key) in locations">
            <div class="p-1 row">
                <location-brief class="col-8" :location="location"></location-brief>
                <div class="button-group offset-2 col-2 ">
                    <div class="button" @click="onDelete(location.id)" v-show="deletePermission == 1">
                        <i class="fas fa-cut" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                           :id="btnDeleteName(location.id)"
                           @mouseover="onMouseOver(btnDeleteName(location.id))"
                           @mouseleave="onMouseLeave(btnDeleteName(location.id))"></i>
                    </div>
                    <div class="button" @click="onEdit(location.id)">
                        <i class="fas fa-pencil-alt" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                           :id="btnEditName(location.id)"
                           @mouseover="onMouseOver(btnEditName(location.id))"
                           @mouseleave="onMouseLeave(btnEditName(location.id))"></i>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <slot name="list-footer"></slot>
    </div>
</template>

<script>
import LocationBrief from "../locations/LocationBrief";

export default {
    name: "LocationsList",
    components: {LocationBrief},
    props: {
        locations: {type: Array},
        token: {type: String},
        deletePermission: {type: Number, default: 0},
    },
    methods: {
        btnDeleteName(key) {
            return 'btnDelete_' + key;
        },
        btnEditName(key) {
            return 'btnEdit_' + key;
        },
        onMouseOver(key) {
            var elem = $('#' + key);
            elem.css('color', key.includes('btnEdit', 0) ? '#ffd200' : '#ec0909');
        },
        onMouseLeave(key) {
            var elem = $('#' + key);
            elem.css('color', '#2d3748');
        },
        onEdit(key) {
            console.log("Key: ", key);
            window.location = '/locations/edit/' + key;
        },
        onDelete(key) {
            let document = this;
            this.$confirm('Запись будет безвозвратно удалена! Продолжить удаление?', 'Вы уверены?').then((result) => {
                if (result) {
                    let fd = new FormData();
                    let self = this;
                    // fd.append('id', this.location.id);
                    fd.append('_token', this.token);
                    $.ajax({
                        url: '/locations/delete/' + key,
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // self.$emit('record-delete', filename);
                            document.$alert('Запись успешно удалена!').then(() => {
                                window.location = '/locations';
                            });
                        },
                        error: function (response) {
                            console.log('Failure! Data is not deleted', response);
                        }
                    });
                }
            });
            // if(window.frames[0].window.confirm("Запись будет безвозвратно удалена! Продолжить удаление?")) {
        },
    },
}
</script>

<style scoped>

.list-item {
    font-size: 1.5rem;
}

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
}

.button-group {
    direction: rtl;
}

.button-group div.button {
    margin-left: 0.5rem;
    display: inline-block;
    cursor: pointer;
}

.button-group::after {
    content: '';
    vertical-align: middle;
    line-height: 100%;
    display: inline-block;
    height: 100%;
}
</style>
