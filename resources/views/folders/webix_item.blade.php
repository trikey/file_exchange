{{--
<div class="folder_container">
    <div class="webix_column webix_first col-lg-3 col-sm-3 col-xs-3 folder_link" data-url="{{ route('admin_folder_view', ['id' => $folder->id]) }}">
        <div data-href="{{ route('admin_folder_view', ['id' => $folder->id]) }}" id="folder_{{ $folder->id }}" class="webix_cell folder context" data-target="#context-menu-{{ $folder->id }}">
            <span class="webix_icon webix_fmanager_icon fa-folder"></span>
            <span class='folder_name'>{{ $folder->name }}</span>
            <input type="text" name="name" value="{{ $folder->name }}" class="folder_rename_input" style="display: none;" data-method="put" data-id="{{ $folder->id }}" data-url="{{route('admin_folders_update', ['id' => $folder->id ])}}"/>
        </div>
    </div>
    <div class="webix_column col-lg-3 col-sm-3 col-xs-3">
        <div class="webix_cell">
            {{ date('d/m/Y H:i', strtotime($folder->updated_at)) }}
        </div>
    </div>
    <div class="webix_column col-lg-3 col-sm-3 col-xs-3">
        <div class="webix_cell">
            {{ $folder->type }}
        </div>
    </div>
    <div class="webix_column col-lg-3 col-sm-3 col-xs-3">
        <div class="webix_cell">
            &nbsp;
        </div>
    </div>


</div>
<div id="context-menu-{{ $folder->id }}">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#" class="rename_folder" data-id="{{ $folder->id }}">{{ trans('folders.rename') }}</a></li>
        <li><a tabindex="-1" href="#" class="delete_folder" data-id="{{ $folder->id }}" data-url="{{ route('admin_folders_delete', ['id' => $folder->id]) }}">{{ trans('folders.delete') }}</a></li>
        <li><a tabindex="-1" href="#" class="move_folder" data-id="{{ $folder->id }}">{{ trans('folders.move') }}</a></li>
    </ul>
</div>
--}}

<div class="row folder_container table-files-row">
    <div class="col-xs-6 table-files-col">
        <div class="webix_column webix_first folder_link" data-url="{{ route('admin_folder_view', ['id' => $folder->id]) }}">
            <div data-href="{{ route('admin_folder_view', ['id' => $folder->id]) }}" id="folder_{{ $folder->id }}" class="webix_cell folder context" data-target="#context-menu-{{ $folder->id }}">
                <span class="icon icon-folder"></span>
                <span class='folder_name'>{{ $folder->name }}</span>
                <input type="text" name="name" value="{{ $folder->name }}" class="folder_rename_input" style="display: none;" data-method="put" data-id="{{ $folder->id }}" data-url="{{route('admin_folders_update', ['id' => $folder->id ])}}"/>
            </div>
        </div>
    </div>
    <div class="col-xs-2 table-files-col">
        <div class="webix_cell">
            {{ date('d/m/Y H:i', strtotime($folder->updated_at)) }}
        </div>
    </div>
    <div class="col-xs-2 table-files-col">
        <div class="webix_cell">
            {{ $folder->type }}
        </div>
    </div>
    <div class="col-xs-2 table-files-col">
        <div class="webix_cell">
            &nbsp;
        </div>
    </div>
</div>
<div id="context-menu-{{ $folder->id }}">
    <ul class="dropdown-menu" role="menu">
        <li><a tabindex="-1" href="#" class="rename_folder" data-id="{{ $folder->id }}">{{ trans('folders.rename') }}</a></li>
        <li><a tabindex="-1" href="#" class="delete_folder" data-id="{{ $folder->id }}" data-url="{{ route('admin_folders_delete', ['id' => $folder->id]) }}">{{ trans('folders.delete') }}</a></li>
        <li><a tabindex="-1" href="#" class="move_folder" data-id="{{ $folder->id }}">{{ trans('folders.move') }}</a></li>
    </ul>
</div>