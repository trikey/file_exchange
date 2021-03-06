<div id="treeFilesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('files.select_section') }}</h4>
            </div>
            <div class="modal-body" id="treeFiles">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('files.close') }}</button>
                <button type="button" class="btn btn-primary select_category_for_file">{{ trans('files.select') }}</button>
            </div>
        </div>

    </div>
</div>