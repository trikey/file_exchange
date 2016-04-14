
<div id="filesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_file_upload" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Загрузка файла</h4>
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
                        {!! Form::label('Описание') !!}
                        {!! Form::textarea('description', null, array('placeholder'=>'', 'class' => 'form-control', 'id' => 'file_name')) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('Выберите файл') !!}
                        {!! Form::file('file', array('id' => 'file')) !!}
                    </div>
                    {!! Form::hidden('folder_id', '0') !!}
                    <ul class="text-danger" id="file-errors" style="display: none;">
                        <li>Название и файл обязательные поля!</li>
                    </ul>
            {!! Form::close() !!}

                    <div class="progress">
                        <div class="bar" style="width: 0px;"></div >
                        {{--<div class="percent">0%</div >--}}
                    </div>

                    <div id="status"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default save_file">Загрузить</button>
                <button type="button" class="btn btn-default close_file_upload" data-dismiss="modal">Закрыть</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src="{{ asset('/assets/js/file_upload.js?'.time()) }}"></script>
