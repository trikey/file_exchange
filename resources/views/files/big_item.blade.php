<!--<div class="row row-with-popup table-files-row folder_container">-->
<!--    <div class="col-lg-6 col-sm-6 col-xs-6 table-files-col">-->
<!--        <div class="webix_cell folder context download_file" data-target="#context-menu-{{ $file->id }}" id="folder_{{ $file->id }}" data-download-href="{{ route('admin_files_download', ['id' => $file->id]) }}">-->
<!--            <span class="icon icon-file icon-file-{{ strtolower($file->type) }}"></span>-->
<!--            <span class='folder_name' title="{{ $file->description }}">{{ $file->description }}</span>-->
<!--            <textarea name="description" class="folder_rename_input" style="display: none;" data-method="put" data-id="{{ $file->id }}" data-url="{{route('admin_files_update', ['id' => $file->id ])}}">{{ $file->description }}</textarea>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-2 col-sm-2 col-xs-2 table-files-col">-->
<!--        <div class="webix_cell">-->
<!--            {{ date('d/m/Y H:i', strtotime($file->updated_at)) }}-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-1 col-sm-1 col-xs-1 table-files-col">-->
<!--        <div class="webix_cell">-->
<!--            {{ ucfirst($file->type) }}-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-1 col-sm-1 col-xs-1 table-files-col">-->
<!--        <div class="webix_cell">-->
<!--            {{ $file->size }}-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-lg-2 col-sm-2 col-xs-2 table-files-col">-->
<!--        <div class="webix_cell">-->
<!--            <div class="link-download-file">-->
<!--                <span>{{ route('admin_files_download', ['id' => $file->id])}}</span>-->
<!--                <div class="btn btn-primary copy-download-link" data-clipboard-text="{{ route('admin_files_download', ['id' => $file->id])}}">{{ trans('files.copy_link') }}</div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="file-popup">-->
<!--        @if( in_array(strtolower($file->type), ['jpg', 'jpeg', 'png']))-->
<!--            <div>-->
<!--                <img src="{{ route('admin_files_download', ['id' => $file->id])}}" alt=""/>-->
<!--            </div>-->
<!--        @endif-->
<!--        <div class="popup-file-name">-->
<!--            <b>{{ $file->description }}</b>-->
<!--        </div>-->
<!--        <div>-->
<!--            {{ trans('folders.type') }}: {{ ucfirst($file->type) }}-->
<!--        </div>-->
<!--        <div>-->
<!--            {{ trans('folders.size') }}: {{ $file->size }}-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="col-sm-4 col-md-3 col-lg-2 folder_container">
    <div class="file-item file-item-info context" data-target="#context-menu-{{ $file->id }}" id="folder_{{ $file->id }}" data-download-href="{{ route('admin_files_download', ['id' => $file->id]) }}" data-get-info="{{route('admin_files_get_info', ['id' => $file->id])}}">
        @if( in_array(strtolower($file->type), ['jpg', 'jpeg', 'png']))
            <div class="big-file icon-big-file icon-big-file-img" style="background-image: url('{{ route('admin_files_download', ['id' => $file->id])}}')"></div>
        @else
            <div class="big-file icon-big-file icon-big-file-{{ strtolower($file->type) }}"></div>
        @endif
        <a href="{{ route('admin_files_download', ['id' => $file->id]) }}" class="folder_name">{{ $file->description }}</a>
        <textarea name="description" class="folder_rename_input" style="display: none;" data-method="put" data-id="{{ $file->id }}" data-url="{{route('admin_files_update', ['id' => $file->id ])}}">{{ $file->description }}</textarea>
    </div>
    <div id="context-menu-{{ $file->id }}">
        <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="#" class="rename_folder" data-id="{{ $file->id }}">{{ trans('files.rename') }}</a></li>
            <li><a tabindex="-1" href="#" class="delete_folder" data-id="{{ $file->id }}" data-url="{{ route('admin_files_delete', ['id' => $file->id]) }}">{{ trans('files.delete') }}</a></li>
            <li><a tabindex="-1" href="#" class="move_file" data-id="{{ $file->id }}">{{ trans('files.move') }}</a></li>
            <li><a tabindex="-1" href="#" class="update_file" data-id="{{ $file->id }}" data-url="{{ route('admin_files_get_modal_update', ['id' => $file->id]) }}">{{ trans('files.re_upload') }}</a></li>
        </ul>
    </div>
</div>