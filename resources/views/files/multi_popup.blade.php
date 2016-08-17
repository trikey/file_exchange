
<div id="multiple_files_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_file_upload" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
                <h4 class="modal-title">{{ trans('files.multiple_file_upload') }}</h4>
            </div>
            <div class="modal-body" id="file_upload">


                {!! Form::open(
                    array(
                        'class' => 'dropzone',
                        'id' => 'dropzone',
                        'novalidate' => 'novalidate',
                        'files' => true)) !!}




                    {!! Form::hidden('folder_id', '0') !!}

                {!! Form::close() !!}



            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal" onclick="window.location.reload()">{{ trans('files.close') }}</button>
                {{--<button type="button" class="btn btn-primary save_file">{{ trans('files.upload') }}</button>--}}
            </div>
        </div>

    </div>
</div>