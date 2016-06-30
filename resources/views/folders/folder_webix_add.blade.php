{{--
<div id="clone_folder" style="display: none;">
    <div class="row folder_container table-files-row">
        <div class="col-xs-6 table-files-col">
            <div class="webix_cell folder context">
                <span class="icon icon-folder"></span>
                <span class='folder_name' style="display: none;">{{ trans('folders.new_folder') }}</span>
                <input type="text" name="name" value="Новая папка" class="folder_rename_input" data-method="post" data-url="{{route('admin_folders_store')}}"/>
            </div>
        </div>
        <div class="col-xs-2 table-files-col">
            <div class="webix_cell">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-2 table-files-col">
            <div class="webix_cell">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-2 table-files-col">
            <div class="webix_cell">
                &nbsp;
            </div>
        </div>
    </div>
</div>
--}}
<div id="clone_folder" style="display: none;">
    <div class="col-sm-4 col-md-3 col-lg-2 folder_container">
        <div class="file-item context"">
            <div class="big-folder"></div>
            <a href="#" class='folder_name' style="display: none;">{{ trans('folders.new_folder') }}</a>
            <input type="text" name="name" value="Новая папка" class="folder_rename_input" data-method="post" data-url="{{route('admin_folders_store')}}"/>
        </div>
    </div>
</div>