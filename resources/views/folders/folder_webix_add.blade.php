<!--<div id="clone_folder" style="display: none;">-->
<!--    <div class="folder_container">-->
<!--        <div class="webix_column webix_first col-lg-3 col-sm-3 col-xs-3">-->
<!--            <div class="webix_cell folder context">-->
<!--                <span class="icon icon-folder"></span>-->
<!--                <span class='folder_name' style="display: none;">{{ trans('folders.new_folder') }}</span>-->
<!--                <input type="text" name="name" value="Новая папка" class="folder_rename_input" data-method="post" data-url="{{route('admin_folders_store')}}"/>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="webix_column col-lg-3 col-sm-3 col-xs-3">-->
<!--            <div class="webix_cell">-->
<!--                &nbsp;-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="webix_column col-lg-3 col-sm-3 col-xs-3">-->
<!--            <div class="webix_cell">-->
<!--                &nbsp;-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="webix_column col-lg-3 col-sm-3 col-xs-3">-->
<!--            <div class="webix_cell">-->
<!--                &nbsp;-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div id="clone_folder" style="display: none;">
    <div class="row folder_container table-files-row">
        <div class="col-xs-6 table-files-col">
            <div class="webix_cell folder context">
                <span class="icon icon-folder"></span>
                <span class='folder_name' style="display: none;">{{ trans('folders.new_folder') }}</span>
                <input type="text" name="name" value="Новая папка" class="folder_rename_input" data-method="post" data-url="{{route('admin_folders_store')}}"/>
            </div>
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