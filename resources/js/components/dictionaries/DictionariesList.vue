<template>
    <div>
        <slot name="list-tittle"></slot>
        <div class="" v-if="objects.length == 0">
            <slot name="list-empty"></slot>
        </div>
        <div class="list-item align-baseline " v-for="(object, key) in objects">
            <div class="row">
                <dictionary-brief class="col-8" :object="object"></dictionary-brief>
                <div class="button-group offset-2 col-2 ">
                    <div class="button-outer-block">
                        <div class="button" @click="onDelete(object.id)" v-show="deletePermission == 1">
                            <i class="fas fa-cut" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                               :id="btnDeleteName(object.id)"
                               @mouseover="onMouseOver(btnDeleteName(object.id))"
                               @mouseleave="onMouseLeave(btnDeleteName(object.id))"></i>
                        </div>
<!--                    </div>-->
<!--                    <div class="outer-block">-->
                        <div class="button" @click="onEdit(object.id)">
                            <i class="fas fa-pencil-alt" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                               :id="btnEditName(object.id)"
                               @mouseover="onMouseOver(btnEditName(object.id))"
                               @mouseleave="onMouseLeave(btnEditName(object.id))"></i>
                        </div>
                    </div>
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
        objects: {type: Array},
        token: {type: String},
        dictionaryId: {type: String},
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
            window.location = '/dictionaries/' + this.dictionaryId + '/edit/' + key;
        },
        onDelete(key) {
            this.$confirm('Запись будет безвозвратно удалена! Продолжить удаление?', 'Вы уверены?').then((result) => {
                if (result) {
                    let fd = new FormData();
                    let self = this;
                    // fd.append('id', this.location.id);
                    fd.append('_token', this.token);
                    $.ajax({
                        url: '/dictionaries/' + self.dictionaryId + '/delete/' + key,
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // self.$emit('record-delete', filename);
                            self.$alert('Запись успешно удалена!').then(() => {
                                window.location = '/dictionaries/' + self.dictionaryId;
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

div.list-item {
    border-bottom: #ced4da solid 1px;
    padding-bottom: 0.25rem;
    font-size: 1.25rem;
}

.button-group {
    direction: rtl;
}

.button-outer-block {
    height: 100%;
    width: max-content;
    padding-right: 1.25rem;
}

.button-group div.button {
    margin-left: 0.5rem;
    cursor: pointer;
    display: inline-block;
    vertical-align: middle;
}

.button-group::after {
    content: '';
    vertical-align: middle;
    line-height: 100%;
    display: inline-block;
    height: 100%;
}
</style>
