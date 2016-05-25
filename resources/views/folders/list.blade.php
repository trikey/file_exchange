@extends('app')

@section('meta_title', trans('folders.meta_title'))


@section('content')
<div class="top-line">
    <div class="row">
        <div class="col-sm-6">
            <h1>{{ trans('folders.files_and_folders') }}</h1>
        </div>
        <div class="col-sm-6 right-text">
            @if(Auth::user()->isAdmin || Auth::user()->isModerator)
            <a href="#" class="btn btn-default add_folder">
                {{ trans('folders.add_folder') }}
            </a>
            <a href="#" class="btn btn-default add_file" data-url="{{ route('admin_files_get_modal') }}">
                {{ trans('folders.upload_file') }}
            </a>
            @endif
        </div>
    </div>
</div>


{{--
{!! Form::open(
                array(
                    'class' => 'form-inline',
                    'novalidate' => 'novalidate',
                    'url' => '/search',
                    'id' => 'search_form',
                    'method' => 'get'
                    )) !!}
<div class="form-group">
    {!! Form::label(trans('folders.search')) !!}
    {!! Form::text('query', isset($search) ? $search : null, array('placeholder'=>'', 'class' => 'form-control', 'id' => 'search')) !!}
</div>
{!! Form::submit(trans('folders.search').'!', array('class' => 'btn btn-primary')) !!}
{!! Form::close() !!}
<br/>
--}}

@include('include.breadcrumbs')

{{--
<div class="webix_view webix_multiview">
    <div class="webix_view webix_dtable webix_fmanager_table">
        <div class="webix_ss_header">
            <div class="webix_hs_center">
                <table cellspacing="0" cellpadding="0" class="col-lg-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="webix_first"><div class="webix_hcell">{{ trans('folders.name') }}</div></td>
                            <td><div class="webix_hcell">{{ trans('folders.date') }}</div></td>
                            <td><div class="webix_hcell">{{ trans('folders.type_size') }}</div></td>
                            <td class="webix_last"><div class="webix_hcell">{{ trans('folders.link') }}</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="webix_ss_body">
            <div class="webix_ss_center col-lg-12 col-sm-12 col-xs-12">
                <div class="webix_ss_center_scroll col-lg-12 col-sm-12 col-xs-12" id="folders" data-parent-id="{{ $parentFolder }}" data-get-tree-url="{{ route('get_folders_tree') }}">
                    @foreach($folders as $folder)
                       @include('folders.webix_item')
                    @endforeach

                    @foreach($files as $file)
                       @include('files.webix_item')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
--}}

<div>
    <div class="table-files">
        <div class="table-files-head">
            <div class="row">
                <div class="col-xs-6 table-files-col">{{ trans('folders.name') }}</div>
                <div class="col-xs-2 table-files-col">{{ trans('folders.date') }}</div>
                <div class="col-xs-2 table-files-col">{{ trans('folders.type_size') }}</div>
                <div class="col-xs-2 table-files-col">{{ trans('folders.link') }}</div>
            </div>
        </div>
        <div class="table-files-body">
            <div id="folders" data-parent-id="{{ $parentFolder }}" data-get-tree-url="{{ route('get_folders_tree') }}">
                @foreach($folders as $folder)
                    @include('folders.webix_item')
                @endforeach

                @foreach($files as $file)
                    @include('files.webix_item')
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('folders.folder_webix_add')

@include('folders.tree')

@include('files.tree')


<div id="file_add_contaier"></div>

@endsection