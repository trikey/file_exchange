@extends('app')

@section('meta_title', trans('folders.meta_title'))


@section('content')

<div class="file-info"></div>

<div class="workspace">
    <div class="top-line">
        <div class="row">
            <div class="col-sm-6">
                @include('include.search')
                <br/>
                <h1>{{ trans('folders.files_and_folders') }}</h1>
            </div>
            <div class="col-sm-6 right-text">
                <a href="{{ route('download_all', ['id' => $parentFolder]) }}" class="btn btn-default download-all">
                    {{ trans('folders.download_all') }}
                </a>
                @if(Auth::user()->isAdmin || Auth::user()->isModerator)
                <a href="#" class="btn btn-default add_folder">
                    {{ trans('folders.add_folder') }}
                </a>
                <a href="#" class="btn btn-default add_file" data-url="{{ route('admin_files_get_modal') }}">
                    {{ trans('folders.upload_file') }}
                </a>
                <a href="#" class="btn btn-default add_multiple_files" data-url="{{ route('admin_files_multi') }}">
                    {{ trans('folders.upload_multiple_files') }}
                </a>
                @endif
            </div>
        </div>
    </div>
    @include('include.breadcrumbs')
    <div class="row row-file" id="folders" data-parent-id="{{$parentFolder}}" data-get-tree-url="{{ route('get_folders_tree') }}">
        @foreach($folders as $folder)
            @include('folders.big_item')
        @endforeach
        @foreach($files as $file)
            @include('files.big_item')
        @endforeach
    </div>
</div>

@include('folders.folder_webix_add')

@include('folders.tree')

@include('files.tree')


<div id="file_add_contaier">@include('files.file_webix_add')</div>
<div id="folder_update_container"></div>

<div id="add_multiple_files_contaier">@include('files.multi_popup')</div>
@endsection