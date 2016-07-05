
<div class="col-sm-4 col-md-3 col-lg-2 folder_container">
    <div class="file-item file-item-info" id="folder_{{ $file->id }}" data-download-href="{{ route('admin_files_download', ['id' => $file->id]) }}" data-get-info="{{route('admin_files_get_info', ['id' => $file->id])}}">
        @if( in_array(strtolower($file->type), ['jpg', 'jpeg', 'png']))
            <div class="big-file icon-big-file icon-big-file-img" style="background-image: url('{{ route('admin_files_download', ['id' => $file->id])}}')"></div>
        @else
            <div class="big-file icon-big-file icon-big-file-{{ strtolower($file->type) }}"></div>
        @endif
        <a href="{{ route('admin_files_download', ['id' => $file->id]) }}" class="folder_name">{{ $file->description }}</a>
    </div>
</div>