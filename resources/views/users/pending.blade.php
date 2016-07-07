@extends('app')


@section('meta_title', trans('users.meta_title'))

@section('content')
<div class="top-line">
    <div class="row">
        <div class="col-sm-6">
            @include('include.search')
            <br/>
            <h1>{{ trans('users.users_list') }}</h1>
        </div>
        <div class="col-sm-6 right-text">
            <a href="{{ route('admin_users_create') }}" class="btn btn-default">
                {{ trans('users.add_user') }}
            </a>
        </div>
    </div>
</div>

{{--
{!! Form::open(
                array(
                    'class' => 'form-inline',
                    'novalidate' => 'novalidate',
                    'url' => '/users/search',
                    'id' => 'search_form',
                    'method' => 'get'
                    )) !!}
<div class="form-group">
    {!! Form::label(trans('users.search')) !!}
    {!! Form::text('query', isset($search) ? $search : null, array('placeholder'=>'', 'class' => 'form-control', 'id' => 'search')) !!}
</div>
{!! Form::submit(trans('users.search').'!', array('class' => 'btn btn-primary')) !!}
{!! Form::close() !!}
<br/>
--}}

    <table class="table custom-table">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>{{ trans('users.fio') }}</th>
                <th>{{ trans('users.organisation') }}</th>
                <th>{{ trans('users.has_access') }}</th>
{{--                <th>{{ trans('users.is_moderator') }}</th>--}}
{{--                <th>{{ trans('users.is_administrator') }}</th>--}}
                <th></th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->fio }}</td>
                    <td>{{ $user->organisation }}</td>
                    <td>{{ $user->canAccess ? trans('users.yes') : trans('users.no') }}</td>
{{--                    <td>{{ $user->isModerator ? trans('users.yes') : trans('users.no') }}</td>--}}
{{--                    <td>{{ $user->isAdmin ? trans('users.yes') : trans('users.no') }}</td>--}}
                    <td>
                    {!! Form::model($user,
                        array(
                            'route' => array('admin_users_confirm', $user->id),
                            'method' => 'put',
                            'novalidate' => 'novalidate',
                            'class' => 'form'
                        )) !!}
                            {!! Form::submit(trans('users.allow_access'), array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                        {{--<form action="/users/confirm/{{ $user->id }}" method="POST">--}}
                            {{--<input name="_method" type="hidden" value="PUT">--}}
                            {{--<input type="submit" value=""/>--}}
                        {{--</form>--}}
                    </td>
                    <td>
                        <span data-placement="top" data-toggle="tooltip" title="Edit"><a class="btn btn-default btn-xs admin_edit" href="{{ route('admin_users_edit', ['id' => $user->id]) }}" data-title="Редактировать"><span class="glyphicon glyphicon-pencil"></span></a></span>
                        <span data-placement="top" data-toggle="tooltip" title="Delete"><a class="btn btn-default btn-xs admin_delete" href="{{ route('admin_users_delete', ['id' => $user->id]) }}" data-title="Удалить"><span class="glyphicon glyphicon-trash"></span></a></span>
                    </td>
                </tr>
            @endforeach

    </table>
    <br/>{!! $users->render() !!}

@endsection