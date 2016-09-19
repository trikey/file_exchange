<template>
    <a href="/download/folder/{{ parentId }}" target="_blank" class="btn btn-default download-all">
        {{ $t('folders.download_all') }}
    </a>
    <a href="#" class="btn btn-default add_folder" v-if="user.isAdmin || user.isModerator" @click.prevent="addFolder($event)">
        {{ $t('folders.add_folder') }}
    </a>
    <a href="#" class="btn btn-default add_file" v-if="user.isAdmin || user.isModerator">
        {{ $t('folders.upload_file') }}
    </a>
    <a href="#" class="btn btn-default add_multiple_files" v-if="user.isAdmin || user.isModerator">
        {{ $t('folders.upload_multiple_files') }}
    </a>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        props: ['user', 'parentId']
        methods:
            addFolder: (e) ->
                this.$emit 'folder-html-added', this.parentId
            addFile: ->
            addMultipleFiles: ->

</script>