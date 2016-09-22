<template>

    <div class="col-sm-4 col-md-3 col-lg-2 folder_container">

        <div class="file-item context" data-target="#folder-context-menu-{{ folder.id }}">
            <div v-link="{name: 'folder', params: { id: folder.id }}" class="big-folder"></div>
            <a v-link="{name: 'folder', params: { id: folder.id }}" class="folder_name" v-show="folder.id">{{ name }}</a>
            <input type="text" name="name" v-model="name" class="folder_rename_input" v-on:blur="onBlur($event, folder)" v-show="folder.id == undefined" />
        </div>

        <context-menu :id="'folder-context-menu-' + folder.id" v-ref:context-menu v-if="folder.id && (user.isAdmin || user.isModerator)">
            <li><a tabindex="-1" href="#" @click.prevent="deleteFolder($event)">{{ $t('folders.delete') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="moveFolder($event)">{{ $t('folders.move') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="renameFolder($event)">{{ $t('folders.rename') }}</a></li>
        </context-menu>
    </div>
</template>


<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    ContextMenu = require('./context_menu')
    FoldersTree = Vue.extend
        props: ['folder', 'user']
        data: ->
            name: null
        ready: ->
            this.name = this.folder.name
        components:
            'context-menu': ContextMenu
        methods:
            deleteFolder: (e) ->
                this.$emit 'deleted', this.folder
                this.$http.post("/api/folders/#{this.folder.id}", { _method: 'delete' })
            moveFolder: (e) ->
                this.selectedFolder = this.folder
                this.$refs.contextMenu.close()
                this.$emit 'moved', this.folder

            renameFolder: (e) ->
                this.selectedFolder = this.folder
                this.$refs.contextMenu.close()
                $(this.$el).find('.folder_name').hide()
                $(this.$el).find('.folder_rename_input').show()

            onBlur: (e, folder) ->
                if folder.id == undefined
                    this.$http.post('/api/folders/create', { name: this.name, parent_id: folder.parentFolderId }).then (response) =>
                        this.$emit 'folder-added', response.data
                else
                    this.$http.post("/api/folders/#{folder.id}/edit", { _method: 'put', name: this.name }).then (response) =>
                        this.folder.name = response.data.name
                        $(this.$el).find('.folder_name').show()
                        $(this.$el).find('.folder_rename_input').hide()

    module.exports = FoldersTree
</script>