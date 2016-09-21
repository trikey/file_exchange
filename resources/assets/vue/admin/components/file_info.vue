<template>
    <div class="file-info opened" v-if="file != undefined">
    <div class="file-info-preview" v-if="['jpg', 'jpeg', 'png'].indexOf(file.type.toLowerCase()) != -1">
        <img :src="file.path" alt=""/>
    </div>
    <p class="file-info-name">
        {{ file.description }}
    </p>
    <p>
        {{ $t('folders.size') }}: {{ file.size }}
    </p>
    <p>
        {{ $t('folders.update') }}: {{ file.updated_at }}
    </p>
    <div class="link-download-file">
        <div class="file-action-block">
            <a class="file-action download" href="/files/{{ file.id }}"></a>
            <a class="file-action addbasket remove-from-file-box" v-if="this.$route.path.indexOf('filebox') != -1" @click.prevent="removeFromFileBox($event)"></a>
            <a class="file-action addbasket add-to-file-box" href="#" v-else @click.prevent="addToFileBox($event)"></a>
        </div>
        <div class="file-action-block-copy-link">
            <div class="btn btn-primary copy-download-link" data-clipboard-text="http://fileexchange.local/files/{{ file.id }}">{{ $t('files.copy_link') }}</div>
        </div>
    </div>
    </div>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    Clipboard = require('clipboard/dist/clipboard.min')
    module.exports = Vue.extend
        props: ['file']
        methods:
            updateClipBoard: ->
                btns = document.querySelectorAll('.copy-download-link') # херь
                clipboard = new Clipboard(btns)
            addToFileBox: (e) ->
                this.$http.post("/api/filebox/#{this.file.id}").then (response) =>
                    $('.basket-count').text(response.data.count)
            removeFromFileBox: (e) ->
                this.$http.post("/api/filebox/remove/#{this.file.id}").then (response) =>
                    $('.basket-count').text(response.data.count)
                    this.$emit 'removed-from-filebox', this.file
        watch:
            file: ->
                this.updateClipBoard() if this.file != null
</script>