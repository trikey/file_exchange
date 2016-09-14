<template>

    <div id="folder_update_container">

        <div id="folderModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ $t('folders.file_update') }}</h4>
                    </div>
                    <div class="modal-body" id="file_upload">

                        <form class="form" novalidate="novalidate" enctype="multipart/form-data" id="file_upload_form" method="post">
                            <input name="_method" type="hidden" value="PUT">
                            <div class="form-group upload-file">
                                <label for="{{ $t('files.select_file') }}">{{ $t('files.select_file') }}</label>
                                <input v-el:image id="file" name="file" type="file" v-model="file">
                            </div>

                            <div class="form-group">
                                <label for="{{ $t('folders.name') }}">{{ $t('folders.name') }}</label>
                                <input placeholder="" class="form-control" id="file_name" name="name" type="text" v-model="folderName">
                            </div>

                            <ul class="text-danger" id="file-errors" v-show="folderName == null || file == null || folderName.length == 0">
                                <li>{{ $t('folders.file_is_obligatory_field') }}</li>
                            </ul>
                        </form>

                        <div class="progress">
                            <div class="bar" style="width: 0px;">0%</div >
                        </div>

                        <div id="status"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal">{{ $t('files.close') }}</button>
                        <button type="button" @click.prevent="onSubmit" class="btn btn-primary save_file">{{ $t('files.upload') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>


<script type="text/coffeescript" lang="coffee">
    #vue-validator
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['folder']
        data: ->
            folderName: null
            file: null
        methods:
            showPopup: ->
                $(this.$el).find('[role=dialog]').modal('show')
            onSubmit: (e) ->
                formData = new FormData()
                formData.append('file', this.$els.image.files[0], this.$els.image.files[0].name)
                formData.append('name', this.folderName)
                formData.append('_method', 'put')

                this.$http.post("/api/folders/#{this.folder.id}/update", formData,
                    progress: (e) =>
                        percentVal = parseInt(e.loaded * 100 / e.total) + '%';
                        $(this.$el).find('.bar').width(percentVal).text(percentVal)
                ).then (response) =>
                    $(this.$el).find('#status').text(response.data)
                    $(this.$el).find('.close_file_upload').click -> window.location.reload()
        watch:
            folder: ->
                if this.folder != null
                    this.folderName = this.folder.name
                    this.showPopup()
</script>