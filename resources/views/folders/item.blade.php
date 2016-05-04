 <div class="folder_container" data-url="{{ route('admin_folder_view', ['id' => $folder->id]) }}">
    <div data-href="{{ route('admin_folder_view', ['id' => $folder->id]) }}" id="folder_{{ $folder->id }}" class="btn btn-info btn-lg folder context" data-target="#context-menu-{{ $folder->id }}">
        <span class="glyphicon glyphicon-folder-close"></span>
        <span class='folder_name'>{{ $folder->name }}</span>
        <input type="text" name="name" value="{{ $folder->name }}" class="folder_rename_input" style="display: none;" data-method="put" data-id="{{ $folder->id }}" data-url="{{route('admin_folders_update', ['id' => $folder->id ])}}"/>
    </div>
    <div id="context-menu-{{ $folder->id }}">
        <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="#" class="rename_folder" data-id="{{ $folder->id }}">{{ trans('folders.rename') }}</a></li>
            <li><a tabindex="-1" href="#" class="delete_folder" data-id="{{ $folder->id }}" data-url="{{ route('admin_folders_delete', ['id' => $folder->id]) }}">{{ trans('folders.delete') }}</a></li>
            <li><a tabindex="-1" href="#" class="move_folder" data-id="{{ $folder->id }}">{{ trans('folders.move') }}</a></li>
        </ul>
    </div>
</div>