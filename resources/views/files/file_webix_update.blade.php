
<div id="filesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('files.file_update') }}</h4>
            </div>
            <div class="modal-body" id="file_upload">

            {!! Form::model($file,
                array(
                    'class' => 'form',
                    'novalidate' => 'novalidate',
                    'files' => true,
                    'url' => route('admin_files_update', $file->id),
                    'id' => 'file_upload_form',
                    'method' => 'put'
                    )) !!}


                    <div class="form-group upload-file">
                        {!! Form::label(trans('files.select_file')) !!}
                        {!! Form::file('file', array('id' => 'file')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label(trans('files.description')) !!}
                        {!! Form::textarea('description', null, array('placeholder'=>'', 'class' => 'form-control file-description', 'id' => 'file_name')) !!}
                    </div>

                    {!! Form::hidden('folder_id', '0') !!}
                    <ul class="text-danger" id="file-errors" style="display: none;">
                        <li>{{ trans('files.name_and_file_are_obligatory_fields') }}</li>
                    </ul>
            {!! Form::close() !!}

                    <div class="progress">
                        <div class="bar" style="width: 0px;"></div >
                        {{--<div class="percent">0%</div >--}}
                    </div>

                    <div id="status"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal">{{ trans('files.close') }}</button>
                <button type="button" class="btn btn-primary save_file">{{ trans('files.upload') }}</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="{{ asset('/assets/js/file_upload.js?'.time()) }}"></script>
