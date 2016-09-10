<template>

    <div class="top-line">
        <div class="row">
            <div class="col-sm-6">
                @include('include.search')
                <br/>
                <h1>{{ $t('folders.files_and_folders') }}</h1>
            </div>
        </div>
    </div>

    <div class="row" id="folders">

        <div class="col-sm-6 col-lg-4" v-for="folder in folders">
            <div class="section-item context">
                <img :src="folder.path" alt=""/>
                <a v-link="{name: 'folder', params: { id: folder.id }}" class="section-link"></a>
                <div class="section-center">
                    <div class="section-title section-title-white">
                        <span>{{ folder.name }}</span> ({{ folder.count }})
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    module.exports = Vue.extend
        created: ->
            this.getRootFolders()
        data: ->
            folders: []
        methods:
            getRootFolders: ->
                this.$http.get('/api').then (response) =>
                    this.folders = response.data
</script>