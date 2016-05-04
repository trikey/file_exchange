@extends('app')


@section('meta_title', trans('users.meta_title_add'))

@section('content')

<h1>{{ trans('users.user_add') }}</h1>
<div class="col-lg-4 col-sm-4 col-xs-4">

{!! Form::open(
    array(
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

@include('users._form')




<div class="form-group">
    {!! Form::submit(trans('users.save'), array('class' => 'btn btn-primary')) !!}
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