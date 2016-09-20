<template>
    <div id="file_add_contaier">

        <div id="filesModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <validator name="fileupload">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ $t('files.file_upload') }}</h4>
                    </div>
                    <div class="modal-body" id="file_upload">

                        <form class="form" novalidate="novalidate" enctype="multipart/form-data" id="file_upload_form" method="post">

                        <div class="form-group">

                            <div class="upload-file">
                                <label for="{{ $t('files.click_add_file') }}">{{ $t('files.click_add_file') }}</label>
                                <input v-el:image id="file" name="file" type="file" v-model="file" v-validate:file="['required']">
                            </div>
                        </div>


                        <ul class="text-danger" id="file-errors">
                            <li v-if="$fileupload.description.required || $fileupload.file.required ">{{ $t('files.name_and_file_are_obligatory_fields') }}</li>
                        </ul>

                        <div class="form-group">
                            <label for="{{ $t('files.description') }}">{{ $t('files.description') }}</label>
                            <textarea name="description" id="file_name" cols="30" rows="10" class="form-control file-description" v-model="description" v-validate:description="['required']"></textarea>
                        </div>
                        </form>

                        <div class="progress">
                            <div class="bar" style="width: 0px;"></div >
                        </div>

                        <div id="status"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal">{{ $t('files.close') }}</button>
                        <button type="button" @click.prevent="onSubmit" class="btn btn-primary save_file" v-if="$fileupload.valid">{{ $t('files.upload') }}</button>
                    </div>
                </div>
                </validator>
            </div>
        </div>


    </div>

</template>

<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['parentId']
        data: ->
            file: null
            description: null
        methods:
            showPopup: ->
                $(this.$el).find('[role=dialog]').modal('show')
            onSubmit: (e) ->
                formData = new FormData()
                formData.append('file', this.$els.image.files[0], this.$els.image.files[0].name)
                formData.append('description', this.description)
                formData.append('folder_id', this.parentId)

                this.$http.post("/api/files/create", formData,
                    progress: (e) =>
                        percentVal = parseInt(e.loaded * 100 / e.total) + '%';
                        $(this.$el).find('.bar').width(percentVal).text(percentVal)
                ).then (response) =>
                    $(this.$el).find('#status').text(response.data)
                    $(this.$el).find('.close_file_upload').click -> window.location.reload()
        watch:
            parentId: ->
                if this.parentId != null
                    this.showPopup()
</script>