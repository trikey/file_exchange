@extends('app')

@section('meta_title', 'REDMOND - Список папок')


@section('content')
<style type="text/css">

.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    padding: 0px;
}
</style>
<h1>Файлы и папки</h1>
@if(Auth::user()->isAdmin || Auth::user()->isModerator)
<a href="#" class="btn btn-primary add_folder">
  <span class="glyphicon glyphicon-plus"></span> Добавить папку
</a>
<a href="#" class="btn btn-primary add_file" data-url="{{ route('admin_files_get_modal') }}">
  <span class="glyphicon glyphicon-plus"></span> Загрузить файл
</a>
<br/><br/>
@endif

{!! Form::open(
                array(
                    'class' => 'form-inline',
                    'novalidate' => 'novalidate',
                    'url' => '/search',
                    'id' => 'search_form',
                    'method' => 'get'
                    )) !!}
<div class="form-group">
    {!! Form::label('Поиск') !!}
    {!! Form::text('query', isset($search) ? $search : null, array('placeholder'=>'', 'class' => 'form-control', 'id' => 'search')) !!}
</div>
{!! Form::submit('Поиск!', array('class' => 'btn btn-primary')) !!}
{!! Form::close() !!}
<br/>
@include('include.breadcrumbs')

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
                            <td class="webix_first"><div class="webix_hcell">Название</div></td>
                            <td><div class="webix_hcell">Дата</div></td>
                            <td><div class="webix_hcell">Тип / Размер</div></td>
                            <td class="webix_last"><div class="webix_hcell">Ссылка</div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="webix_ss_body">
            <div class="webix_ss_center col-lg-12 col-sm-12 col-xs-12">
                <div class="webix_ss_center_scroll col-lg-12 col-sm-12 col-xs-12" id="folders" data-parent-id="{{ $parentFolder }}" data-get-tree-url="{{ route('get_folders_tree') }}" data->
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

@include('folders.folder_webix_add')

@include('folders.tree')

@include('files.tree')


<div id="file_add_contaier"></div>

@endsection