<template>

    <div class="col-sm-4 col-md-3 col-lg-2 folder_container">
        <div class="file-item file-item-info context" data-target="#file-context-menu-{{ file.id }}">
            <div v-if="['jpg', 'jpeg', 'png'].indexOf(file.type) != -1" class="big-file icon-big-file icon-big-file-img" v-bind:style="{ 'background-image': 'url(' + file.path + ')' }"></div>
            <div v-else class="big-file icon-big-file icon-big-file-{{ file.type.toLowerCase() }}"></div>
            <a href="/files/{{ file.id }}" class="folder_name">{{ file.description }}</a>
            <textarea name="description" class="folder_rename_input" v-show="1 == false" v-model="description"></textarea>
        </div>


        <context-menu :id="'file-context-menu-' + file.id" v-ref:context-menu v-if="file.id">
            <li><a tabindex="-1" href="#" @click.prevent="deleteFile($event)">{{ $t('files.delete') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="moveFile($event)">{{ $t('files.move') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="renameFile($event)">{{ $t('files.rename') }}</a></li>
            <li><a tabindex="-1" href="#" @click.prevent="updateFile($event)">{{ $t('files.re_upload') }}</a></li>
        </context-menu>
    </div>

</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    ContextMenu = require('./context_menu')
    module.exports = Vue.extend
        props: ['file']
        data: ->
            description: null
        ready: ->
            this.description = this.file.description
        components:
            'context-menu': ContextMenu
        methods:
            deleteFile: (e) ->
                this.$emit 'deleted-file', this.file
                this.$http.post("/api/files/#{this.file.id}", { _method: 'delete' })
            moveFile: (e) ->
                this.$refs.contextMenu.close()
                this.$emit 'moved-file', this.file

</script>