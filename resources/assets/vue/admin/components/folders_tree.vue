<template>
<div id="treeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $t('folders.select_section') }}</h4>
            </div>
            <div class="modal-body">
                <tree-view :data="foldersTree" @node-selected="nodeSelected"></tree-view>
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
    TreeView = require('./tree_view')

    FoldersTree = Vue.extend
        props: ['folder', 'foldersTree']
        components:
            'tree-view': TreeView
        data: ->
            curParentId: null
        ready: ->
            $(this.$el).on 'hidden.bs.modal', =>
                this.$emit 'hidden-bs-modal'
        methods:
            moveFolder: (e) ->
                this.$http.post("/api/folders/#{this.folder.id}/edit", { _method: 'put', parent_id: this.curParentId, is_ajax: 'Y' }).then (response) =>
                    window.location.reload()
            showTree: ->
                $(this.$el).modal('show')
            nodeSelected: (data) ->
                this.curParentId = data.id
        watch:
            foldersTree: ->
                this.showTree() if this.foldersTree != null

    module.exports = FoldersTree
</script>