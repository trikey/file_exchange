@extends('app')


@section('meta_title', 'REDMOND - Редактирование пользователя')

@section('content')

<h1>Редактирование пользователя</h1>

<div class="col-lg-4 col-sm-4 col-xs-4">
{!! Form::model($user,
    array(
        'route' => array('admin_users_update', $user->id),
        'method' => 'put',
        'novalidate' => 'novalidate',
        'class' => 'form'
    )) !!}

@include('users._form')




<div class="form-group">
    {!! Form::submit('Сохранить!', array('class' => 'btn btn-primary')) !!}
</div>
{!! Form::close() !!}

@if($errors)
    <ul class="text-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
</div>

@endsection