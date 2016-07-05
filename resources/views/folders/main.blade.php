@extends('app')

@section('meta_title', trans('folders.meta_title'))


@section('content')
<div class="top-line">
    <div class="row">
        <div class="col-sm-6">
            @include('include.search')
            <br/>
            <h1>{{ trans('folders.files_and_folders') }}</h1>
        </div>
    </div>
</div>

@include('include.breadcrumbs')

<div class="row" id="folders" data-get-tree-url="{{ route('get_folders_tree') }}">
    @foreach($folders as $folder)
        @if(strlen($folder->path) > 0)
            <div class="col-sm-6 col-lg-4">
                <div class="section-item context" data-target="#context-menu-{{ $folder->id }}">
                    <img src="{{ $folder->path }}" alt=""/>
                    <a href="{{ route('admin_folder_view', ['id' => $folder->id]) }}" class="section-link"></a>
                    <div class="section-center">
                        <div class="section-title @if($folder->id == '87') section-title-white @endif">
                            <span>{{ $folder->name }}</span> ({{ $folder->count }})
                        </div>
                    </div>
                </div>
                <div id="context-menu-{{ $folder->id }}">
                    <ul class="dropdown-menu" role="menu">
                        <li><a tabindex="-1" href="#" class="delete_folder" data-id="{{ $folder->id }}" data-url="{{ route('admin_folders_delete', ['id' => $folder->id]) }}">{{ trans('folders.delete') }}</a></li>
                        <li><a tabindex="-1" href="#" class="move_folder" data-id="{{ $folder->id }}">{{ trans('folders.move') }}</a></li>
                        <li><a tabindex="-1" href="#" class="update_folder" data-id="{{ $folder->id }}" data-url="{{ route('admin_folders_get_modal_update', ['id' => $folder->id]) }}">{{ trans('folders.update_preview_picture') }}</a></li>
                    </ul>
                </div>
            </div>
        @endif
    @endforeach
</div>

@include('folders.tree')
@include('files.tree')


<div id="folder_update_container"></div>

@endsection