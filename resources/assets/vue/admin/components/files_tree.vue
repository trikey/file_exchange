<template>

<div id="treeFilesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $t('files.select_section') }}</h4>
            </div>
            <div class="modal-body" id="treeFiles">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ $t('files.close') }}</button>
                <button type="button" class="btn btn-primary select_category_for_file">{{ $t('files.select') }}</button>
            </div>
        </div>

    </div>
</div>
</template>
<script type="text/coffeescript" lang="coffee">
    Vue = require('vue')
    FilesTree = Vue.extend({})
    module.exports = FilesTree
</script>