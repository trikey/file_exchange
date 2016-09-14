<template>

    <div class="col-sm-6 col-lg-4">

        <div class="section-item context" data-target="#folder-context-menu-{{ folder.id }}">
            <img :src="folder.path" alt=""/>
            <a v-link="{name: 'folder', params: { id: folder.id }}" class="section-link"></a>
            <div class="section-center">
                <div :class="{ 'section-title': true, 'section-title-white': folder.id == 1 }">
                    <span>{{ folder.name }}</span> ({{ folder.count }})
                </div>
            </div>
        </div>


        <context-menu :id="'folder-context-menu-' + folder.id" v-ref:context-menu>
            <li><a tabindex="-1" href="#" @click.prevent="deleteFolder($event)">{{ $t('folders.delete') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="moveFolder($event)">{{ $t('folders.move') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="updateFolder($event)">{{ $t('folders.update_preview_picture') }}</a></li>
        </context-menu>

    </div>

</template>


<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    ContextMenu = require('./context_menu')
    FoldersTree = Vue.extend
        props: ['folder']
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

            updateFolder: (e) ->
                this.selectedFolder = this.folder
                this.$refs.contextMenu.close()
                this.$http.get("/api/modal/#{this.folder.id}").then (response) =>
                    this.$emit 'prepared-for-update', response.data

    module.exports = FoldersTree
</script>