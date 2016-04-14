@extends('app')


@section('meta_title', 'REDMOND - Добавление пользователя')

@section('content')

<h1>Добавление пользователя</h1>
<div class="col-lg-4 col-sm-4 col-xs-4">

{!! Form::open(
    array(
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

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