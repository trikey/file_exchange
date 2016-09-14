<template>

    <div class="top-line">
        <div class="row">
            <div class="col-sm-6">
                <searchform></searchform>
                <br/>
                <h1>{{ $t('folders.files_and_folders') }}</h1>
            </div>
        </div>
    </div>

    <div class="row" id="folders">
        <folder v-for="folder in folders" v-show="folder.path" :folder="folder" @deleted="onDeleted" @moved="onMoved" @prepared-for-update="onPreparedForUpdate"></folder>
    </div>

    <folderstree :folder="selectedFolder" :folders-tree="foldersTree" @hidden-bs-modal="onHiddenBsModal"></folderstree>


    <folder-update-popup :folder="selectedFolderForUpdate"></folder-update-popup>


</template>

<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    SearchForm = require('_admin/components/search_form')
    FoldersTree = require('_admin/components/folders_tree')
    Folder = require('_admin/components/folder')
    FolderUpdatePopup = require('_admin/components/folder_update_popup')

    module.exports = Vue.extend
        created: ->
            this.getRootFolders()
        data: ->
            folders: []
            selectedFolder: null,
            selectedFolderForUpdate: null
            foldersTree: null,
        components:
            searchform: SearchForm
            folderstree: FoldersTree
            folder: Folder
            'folder-update-popup': FolderUpdatePopup
        methods:
            getRootFolders: ->
                this.$http.get('/api').then (response) =>
                    this.folders = response.data
            onDeleted: (folder) ->
                this.folders.$remove(folder)
            onMoved: (folder) ->
                this.selectedFolder = folder
                this.$http.get('/api/tree').then (response) =>
                    this.foldersTree = response.data
            onHiddenBsModal: ->
                this.foldersTree = null
                this.selectedFolder = null

            onPreparedForUpdate: (folder) ->
                this.selectedFolderForUpdate = folder
</script>