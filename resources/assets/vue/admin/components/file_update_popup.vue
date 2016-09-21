<template>

    <div id="filesModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <validator name="validation1">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $t('files.file_update') }}</h4>
                </div>
                <div class="modal-body" id="file_upload">
                    <form class="form" novalidate="novalidate" enctype="multipart/form-data" id="file_upload_form" method="post">
                        <input name="_method" type="hidden" value="PUT">

                        <div class="form-group upload-file">
                            <label for="{{ $t('files.select_file') }}">{{ $t('files.select_file') }}</label>
                            <input v-el:image id="file" name="file" type="file" v-model="file" v-validate:file="['required']">
                        </div>

                        <div class="form-group">
                            <label for="{{ $t('files.description') }}">{{ $t('files.description') }}</label>
                            <textarea class="form-control file-description" id="description" v-model="description" v-validate:description="['required']"></textarea>
                        </div>

                        <ul class="text-danger" id="file-errors">
                            <li v-if="$validation1.description.required || $validation1.file.required ">{{ $t('files.name_and_file_are_obligatory_fields') }}</li>
                        </ul>
                    </form>

                    <div class="progress">
                        <div class="bar" style="width: 0px;">0%</div >
                    </div>

                    <div id="status"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal">{{ $t('files.close') }}</button>
                    <button type="button" @click.prevent="onSubmit" class="btn btn-primary save_file" v-if="$validation1.valid">{{ $t('files.upload') }}</button>
                </div>
                </div>
                </validator>

            </div>
        </div>

</template>


<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['currentFile']
        data: ->
            description: null
            file: null
        methods:
            showPopup: ->
                $(this.$el).modal('show')
            onSubmit: (e) ->
                formData = new FormData()
                formData.append('file', this.$els.image.files[0], this.$els.image.files[0].name)
                formData.append('description', this.description)
                formData.append('_method', 'put')

                this.$http.post("/api/files/#{this.currentFile.id}/edit", formData,
                    progress: (e) =>
                        percentVal = parseInt(e.loaded * 100 / e.total) + '%';
                        $(this.$el).find('.bar').width(percentVal).text(percentVal)
                ).then (response) =>
                    $(this.$el).find('#status').text(response.data)
                    $(this.$el).find('.close_file_upload').click -> window.location.reload()
        watch:
            currentFile: ->
                if this.currentFile != null
                    this.description = this.currentFile.description
                    this.showPopup()
</script>