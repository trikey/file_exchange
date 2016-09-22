<template>
    <file-info :file="selectedFileForInfo"></file-info>

    <div class="workspace">
        <div class="top-line">
            <div class="row">
                <div class="col-sm-6">
                    <search-form></search-form>
                    <br/>
                    <h1>{{ $t('folders.files_and_folders') }}</h1>
                </div>
                <div class="col-sm-6 right-text">
                    <admin-menu :user="user" :parent-id="parentFolderId" :ready-to-add-folder="readyToAddFolder" @folder-html-added="onFolderHtmlAdded" @file-html-added="onFileHtmlAdded" @multiple-file-html-added="onMultipleFileHtmlAdded"></admin-menu>
                </div>
            </div>
        </div>


        <breadcrumbs :breadcrumbs="breadcrumbs"></breadcrumbs>


        <div class="row row-file" id="folders">
            <folder-child v-for="folder in folders" :user="user" :folder="folder" @folder-added="onFolderAdded" @deleted="onDeleted" @moved="onMoved"></folder-child>
            <file v-for="file in files" :user="user" :file="file" @file-clicked="onFileClicked" @deleted-file="onDeletedFile" @moved-file="onMovedFile" @prepared-file-for-update="onPreparedForUpdate"></file>
        </div>
    </div>
    <folders-tree :folder="selectedFolder" :file="selectedFile" :folders-tree="foldersTree" @hidden-bs-modal="onHiddenBsModal"></folders-tree>


    <file-add-popup :parent-id="selectedParentId" @hidden-bs-modal="onHiddenBsModal"></file-add-popup>
    <multiple-files-add-popup :parent-id="selectedParentIdForMultiple" @hidden-bs-modal="onHiddenBsModal"></multiple-files-add-popup>
    <file-update-popup :current-file="selectedFileForUpdate"></file-update-popup>

</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')

    SearchForm = require('_admin/components/search_form')
    FoldersTree = require('_admin/components/folders_tree')
    FolderChild = require('_admin/components/folder_child')
    AdminMenu = require('_admin/components/admin_menu')
    Breadcrumbs = require('_admin/components/breadcrumbs')
    FileAddPopup = require('_admin/components/file_add_popup')
    MultipleFilesAddPopup = require('_admin/components/multiple_files_add_popup')
    File = require('_admin/components/file')
    FileUpdatePopup = require('_admin/components/file_update_popup')
    FileInfo = require('_admin/components/file_info')

    module.exports = Vue.extend
        created: ->
            this.getUser()
            this.getFolderAndFiles(this.$route.params.id)
            this.breadcrumbs = []
        data: ->
            folders: []
            selectedFolder: null,
            selectedFile: null,
            selectedFileForUpdate: null,
            selectedFileForInfo: null,
            foldersTree: null,
            user: {},
            parentFolderId: this.$route.params.id,
            breadcrumbs: [],
            readyToAddFolder: true,
            selectedParentId: null,
            selectedParentIdForMultiple: null,
            files: []
        route:
            data: (transition) ->
                this.getFolderAndFiles(this.$route.params.id)
        components:
            'search-form': SearchForm
            'folders-tree': FoldersTree
            'folder-child': FolderChild
            'file-update-popup': FileUpdatePopup
            'admin-menu': AdminMenu
            'breadcrumbs': Breadcrumbs
            'file-add-popup': FileAddPopup
            'multiple-files-add-popup': MultipleFilesAddPopup
            'file': File,
            'file-info': FileInfo
        methods:
            getUser: ->
                this.$http.get('api/user').then (response) =>
                    this.user = response.data
            onFolderHtmlAdded: (parentFolderId) ->
                this.readyToAddFolder = false
                this.folders.push
                    name: 'New Folder',
                    parentFolderId: parentFolderId
            onFolderAdded: (folder) ->
                this.folders.pop()
                this.folders.push(folder)
                this.readyToAddFolder = true
            getFolderAndFiles: (folderId) ->
                this.$http.get("/api/#{folderId}").then (response) =>
                    this.folders = response.data.folders
                    this.files = response.data.files
                    this.breadcrumbs = response.data.breadcrumbs
            onDeleted: (folder) ->
                this.folders.$remove(folder)
            onDeletedFile: (file) ->
                this.files.$remove(file)
            onMoved: (folder) ->
                this.selectedFolder = folder
                this.$http.get('/api/tree').then (response) =>
                    this.foldersTree = response.data
            onMovedFile: (file) ->
                console.log file
                this.selectedFile = file
                this.$http.get('/api/tree').then (response) =>
                    this.foldersTree = response.data
            onHiddenBsModal: ->
                this.foldersTree = null
                this.selectedFolder = null
                this.selectedFile = null
                this.selectedParentId = null
                this.selectedParentIdForMultiple = null
            onPreparedForUpdate: (file) ->
                this.selectedFileForUpdate = file
            onFileHtmlAdded: (parentFolderId) ->
                this.selectedParentId = parentFolderId
            onMultipleFileHtmlAdded: (parentFolderId) ->
                this.selectedParentIdForMultiple = parentFolderId
            onFileClicked: (file) ->
                this.selectedFileForInfo = file
</script>