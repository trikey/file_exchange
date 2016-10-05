<template>
    <file-info :file="selectedFileForInfo" @removed-from-filebox="onRemovedFromFileBox"></file-info>

    <div class="workspace">
        <div class="top-line">
            <div class="row">
                <div class="col-sm-6">
                    <br/>
                    <h1>{{ $t('menu.basket') }}</h1>
                </div>
                <div class="col-sm-6 right-text">
                    <a href="/download_filebox" class="btn btn-default" v-if="files.length > 0">
                        {{ $t('folders.download_all') }}
                    </a>
                </div>
            </div>
        </div>

        <breadcrumbs :breadcrumbs="breadcrumbs"></breadcrumbs>

        <div class="row row-file" id="folders" v-if="files.length > 0">
            <file v-for="file in files" :file="file" @file-clicked="onFileClicked"></file>
        </div>
        <p class="text-info" v-else>{{ $t('menu.filebox_empty') }}</p>

    </div>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    FileInfo = require('_admin/components/file_info')
    Breadcrumbs = require('_admin/components/breadcrumbs')
    File = require('_admin/components/file')

    module.exports = Vue.extend
        created: ->
            this.getFiles()
        components:
            'file-info': FileInfo
            'breadcrumbs': Breadcrumbs
            'file': File
        data: ->
            selectedFileForInfo: null
            breadcrumbs: []
            files: []
        methods:
            getFiles: ->
                this.$http.get('/api/filebox/index').then (response) =>
                    this.files = response.data.files
                    this.breadcrumbs = response.data.breadcrumbs
            onFileClicked: (file) ->
                this.selectedFileForInfo = file
            onRemovedFromFileBox: (file) ->
                this.files.$remove(file)
                this.selectedFileForInfo = null
</script>