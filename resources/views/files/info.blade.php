@if( in_array(strtolower($file->type), ['jpg', 'jpeg', 'png']))
<div class="file-info-preview">
    <img src="{{ route('admin_files_download', ['id' => $file->id])}}" alt=""/>
</div>
@endif
<p class="file-info-name">
    {{ $file->description }}
</p>
<p>
    {{ trans('folders.size') }}: {{ $file->size }}
</p>
<p>
    {{ trans('folders.update') }}: {{ date('d/m/Y H:i', strtotime($file->updated_at)) }}
</p>
<!--<div class="file-info-description">-->
<!--    <p>-->
<!--        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas egestas varius mauris eu eleifend. Vivamus luctus egestas aliquam. Nunc posuere lacus id sapien cursus, eget venenatis magna efficitur.-->
<!--    </p>-->
<!--    <p>-->
<!--        Cras ac consectetur nunc. Nam tincidunt fermentum suscipit. Donec vulputate tristique sollicitudin. Aliquam volutpat aliquam augue.-->
<!--    </p>-->
<!--</div>-->
<div class="link-download-file">
    <div class="file-action-block">
        <a class="file-action download" href="{{ route('admin_files_download', ['id' => $file->id])}}"></a>
        <a class="file-action addbasket" href="#"></a>
    </div>
    <div class="file-action-block-copy-link">
        <div class="btn btn-primary copy-download-link" data-clipboard-text="{{ route('admin_files_download', ['id' => $file->id])}}">{{ trans('files.copy_link') }}</div>
    </div>
</div>