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

        <div class="col-sm-6 col-lg-4" v-for="folder in folders" v-show="folder.path">
            <div class="section-item context" data-target="#context-menu-{{ folder.id }}">
                <img :src="folder.path" alt=""/>
                <a v-link="{name: 'folder', params: { id: folder.id }}" class="section-link"></a>
                <div class="section-center">
                    <div :class="{ 'section-title': true, 'section-title-white': folder.id == 87 }">
                        <span>{{ folder.name }}</span> ({{ folder.count }})
                    </div>
                </div>
            </div>

            <div id="context-menu-{{ folder.id }}">
                <ul class="dropdown-menu" role="menu">
                    <li><a tabindex="-1" href="#" @click.prevent="deleteFolder(folder, $event)">{{ $t('folders.delete') }}</a></li>
                    <li><a tabindex="-1" href="#" @click.prevent="moveFolder(folder, $event)">{{ $t('folders.move') }}</a></li>
                    <li><a tabindex="-1" href="#" @click.prevent="updateFolder(folder, $event)" class="update_folder">{{ $t('folders.update_preview_picture') }}</a></li>
                </ul>
            </div>
        </div>

    </div>

    <folderstree :folder="selectedFolder" :parentid="curParentId"></folderstree>
    <filestree></filestree>


    <div id="folder_update_container"></div>

</template>

<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    SearchForm = require('../components/search_form')
    FoldersTree = require('../components/folders_tree')
    FilesTree = require('../components/files_tree')
    module.exports = Vue.extend
        created: ->
            this.getRootFolders()
        data: ->
            folders: []
            curParentId: 0
            selectedFolder: {}
        components:
            searchform: SearchForm
            folderstree: FoldersTree
            filestree: FilesTree
        methods:
            getRootFolders: ->
                this.$http.get('/api').then (response) =>
                    this.folders = response.data
                    this.$nextTick -> # возможно ли вынести contextmenu в отдельный компонент учитывая что в этот компонент нужно передать объект folder
                        $('.context').contextmenu()
            deleteFolder: (folder, e) ->
                this.folders.$remove(folder) # как достучаться до this.folders внутри промиса
                this.$http.post("/api/folders/#{folder.id}", { _method: 'delete' }).then (response) =>
                    console.log 'worked'
            moveFolder: (folder, e) ->
                this.selectedFolder = folder
                $("[data-target=context-menu-#{folder.id}]").contextmenu('close', e)
                this.$http.get('/api/tree').then (response) =>
                    $('#tree').treeview
                        data: response.data
                        onNodeSelected: (event, data) =>
                            this.curParentId = data.id
                    $('#treeModal').modal('show')
            updateFolder: (folder, e) ->
                this.selectedFolder = folder
                $("[data-target=context-menu-#{folder.id}]").contextmenu('close', e)
                this.$http.get("/api/modal/#{folder.id}").then (response) =>
                    $('#folder_update_container').html(response.data);
                    $('#folderModal').modal('show')
</script>