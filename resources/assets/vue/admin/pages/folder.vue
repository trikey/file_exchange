<template>

    <div class="top-line">
        <div class="row">
            <div class="col-sm-6">
                <search-form></search-form>
                <br/>
                <h1>{{ $t('folders.files_and_folders') }}</h1>
            </div>
            <div class="col-sm-6 right-text">
                <admin-menu :user="user" :parent-id="parentFolderId" @folder-html-added="onFolderHtmlAdded"></admin-menu>
            </div>
        </div>
    </div>

    <div class="row row-file" id="folders">
        <folder-child v-for="folder in folders" :folder="folder" @folder-added="onFolderAdded" @deleted="onDeleted" @moved="onMoved"></folder-child>
    </div>

    <folders-tree :folder="selectedFolder" :folders-tree="foldersTree" @hidden-bs-modal="onHiddenBsModal"></folders-tree>


    <folder-update-popup :folder="selectedFolderForUpdate"></folder-update-popup>


</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')

    SearchForm = require('_admin/components/search_form')
    FoldersTree = require('_admin/components/folders_tree')
    FolderChild = require('_admin/components/folder_child')
    FolderUpdatePopup = require('_admin/components/folder_update_popup')
    AdminMenu = require('_admin/components/admin_menu')

    module.exports = Vue.extend
        created: ->
            this.getUser()
            this.getFolderAndFiles(this.$route.params.id)
        data: ->
            folders: []
            selectedFolder: null,
            selectedFolderForUpdate: null
            foldersTree: null,
            user: {},
            parentFolderId: this.$route.params.id
        components:
            'search-form': SearchForm
            'folders-tree': FoldersTree
            'folder-child': FolderChild
            'folder-update-popup': FolderUpdatePopup
            'admin-menu': AdminMenu
        methods:
            getUser: ->
                this.$http.get('api/user').then (response) =>
                    this.user = response.data
                    console.log this.user
            onFolderHtmlAdded: (parentFolderId) ->
                this.folders.push
                    name: 'New Folder',
                    parentFolderId: parentFolderId
            onFolderAdded: (folder) ->
                this.folders.pop()
                this.folders.push(folder)
            getFolderAndFiles: (folderId) ->
                this.$http.get("/api/#{folderId}").then (response) =>
                    this.folders = response.data.folders
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