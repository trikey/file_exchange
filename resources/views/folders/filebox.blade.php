@extends('app')

@section('meta_title', trans('menu.basket'))


@section('content')

<div class="file-info"></div>

<div class="workspace">
    <div class="top-line">
        <div class="row">
            <div class="col-sm-6">
{{--                @include('include.search')--}}
                <br/>
                <h1>{{ trans('menu.basket') }}</h1>
            </div>
            <div class="col-sm-6 right-text">
                @if(count(session('file_box')) > 0)
                <a href="{{ route('download_filebox') }}" class="btn btn-default">
                    {{ trans('folders.download_all') }}
                </a>
                @endif
            </div>
        </div>
    </div>
    @include('include.breadcrumbs')
        @if(empty($files))
            <p class="text-info">{{ trans('menu.filebox_empty') }}</p>
        @else
            <div class="row row-file" id="folders" data-parent-id="{{$parentFolder}}" data-get-tree-url="{{ route('get_folders_tree') }}">
                @foreach($files as $file)
                    @include('files.big_item_filebox')
                @endforeach
            </div>
        @endif
</div>


<div id="file_add_contaier"></div>
<div id="folder_update_container"></div>

@endsection