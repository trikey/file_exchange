
<div id="filesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ trans('files.file_upload') }}</h4>
            </div>
            <div class="modal-body" id="file_upload">

            {!! Form::open(
                array(
                    'class' => 'form',
                    'novalidate' => 'novalidate',
                    'files' => true,
                    'url' => route('admin_files_store'),
                    'id' => 'file_upload_form'
                    )) !!}

                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('Название') !!}--}}
                        {{--{!! Form::text('name', null, array('placeholder'=>'', 'class' => 'form-control', 'id' => 'file_name')) !!}--}}
                    {{--</div>--}}

                    <div class="form-group">
<!--                        {!! Form::label(trans('files.select_file')) !!}-->

                        <div class="upload-file">
                            {!! trans('files.click_add_file') !!}
                            {!! Form::file('file', array('id' => 'file')) !!}
                        </div>
                        <div class="upload-file-name"></div>
                    </div>


                    {!! Form::hidden('folder_id', '0') !!}
                    <ul class="text-danger" id="file-errors" style="display: none;">
                        <li>{{ trans('files.name_and_file_are_obligatory_fields') }}</li>
                    </ul>

                    <div class="form-group">
                        {!! Form::label(trans('files.description')) !!}
                        {!! Form::textarea('description', null, array('placeholder'=>'', 'class' => 'form-control file-description', 'id' => 'file_name')) !!}
                    </div>
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
