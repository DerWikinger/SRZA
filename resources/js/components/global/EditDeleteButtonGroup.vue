<template>
    <div class="button-group row">
        <div class="button-outer-block">
            <div class="button" @click="onDelete(id)" v-show="deletePermission == 1">
                <i class="fas fa-cut" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                   :id="btnDeleteName(id)"
                   @mouseover="onMouseOver(btnDeleteName(id))"
                   @mouseleave="onMouseLeave(btnDeleteName(id))"></i>
            </div>
            <div class="button" @click="onEdit(id)">
                <i class="fas fa-pencil-alt" style="font-size:1.25rem;vertical-align:middle;color:#2d3748"
                   :id="btnEditName(id)"
                   @mouseover="onMouseOver(btnEditName(id))"
                   @mouseleave="onMouseLeave(btnEditName(id))"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditDeleteButtonGroup",
    props: {
        id: {type: Number},
        baseRoute: {type: String},
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
            // console.log("Key: ", key);
            window.location = this.baseRoute + '/edit/' + key;
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
                        url: self.baseRoute + '/delete/' + key,
                        data: fd,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // self.$emit('record-delete', filename);
                            document.$alert('Запись успешно удалена!').then(() => {
                                window.location = window.location;
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

.button-group {
    direction: rtl;
}

.button-outer-block {
    width: max-content;
    padding-right: 1.25rem;
    display: inline-block;
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
