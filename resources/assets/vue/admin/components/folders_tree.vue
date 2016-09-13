<template>
<div id="treeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $t('folders.select_section') }}</h4>
            </div>
            <div class="modal-body" id="tree">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('folders.close') }}</button>
                <button type="button" class="btn btn-primary select_category" @click="moveFolder($event)">{{ $t('folders.select') }}</button>
            </div>
        </div>

    </div>
</div>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    FoldersTree = Vue.extend
        props: ['folder', 'parentid']
        methods:
            moveFolder: (e) ->
                this.$http.post("/api/folders/#{this.folder.id}/edit", { _method: 'put', parent_id: this.parentid, is_ajax: 'Y' }).then (response) =>
                    window.location.reload()
    module.exports = FoldersTree
</script>