@extends('app')


@section('meta_title', 'REDMOND - Список пользователей')

@section('content')

<h1>Список пользователей</h1>
<a href="{{ route('admin_users_create') }}" class="btn btn-primary">
  <span class="glyphicon glyphicon-plus"></span> Добавить пользователя
</a>
<br/><br/>

{!! Form::open(
                array(
                    'class' => 'form-inline',
                    'novalidate' => 'novalidate',
                    'url' => '/users/search',
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


    <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Ф.И.О.</th>
                <th>Организация</th>
                <th>Есть доступ?</th>
                <th>Является модератором?</th>
                <th>Является администратором?</th>
                <th></th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->fio }}</td>
                    <td>{{ $user->organisation }}</td>
                    <td>{{ $user->canAccess ? "да" : "нет" }}</td>
                    <td>{{ $user->isModerator ? "да" : "нет" }}</td>
                    <td>{{ $user->isAdmin ? "да" : "нет" }}</td>
                    <td>
                        <span data-placement="top" data-toggle="tooltip" title="Edit"><a class="btn btn-primary btn-xs admin_edit" href="{{ route('admin_users_edit', ['id' => $user->id]) }}" data-title="Редактировать"><span class="glyphicon glyphicon-pencil"></span></a></span>
                        <span data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-danger btn-xs admin_delete" href="{{ route('admin_users_delete', ['id' => $user->id]) }}" data-title="Удалить"><span class="glyphicon glyphicon-trash"></span></a></span>
                    </td>
                </tr>
            @endforeach

    </table>
    <br/>{!! $users->render() !!}

@endsection