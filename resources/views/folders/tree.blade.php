<div id="treeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('folders.select_section') }}</h4>
            </div>
            <div class="modal-body" id="tree">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default select_category">{{ trans('folders.select') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('folders.close') }}</button>
            </div>
        </div>

    </div>
</div>