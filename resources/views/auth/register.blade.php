@extends('app')

@section('meta_title', trans('registration.meta_title'))


@section('content')
<div class="auth-form center-block">
    <ul class="nav nav-pills auth-nav">
        <li role="presentation"><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
        <li role="presentation" class="active"><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
    </ul>
    <form  method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <div class="form-group required{{ $errors->has('fio') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('registration.fio') }}</label>

            <div class="">
                <input type="text" class="form-control" name="fio" value="{{ old('fio') }}">

                @if ($errors->has('fio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fio') }}</strong>
                                </span>
                @endif
            </div>
        </div>
        <div class="form-group required{{ $errors->has('organisation') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('registration.organisation') }}</label>

            <div>
                <input type="text" class="form-control" name="organisation" value="{{ old('organisation') }}">

                @if ($errors->has('organisation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('organisation') }}</strong>
                                </span>
                @endif
            </div>
        </div>

        <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('registration.email') }}</label>

            <div>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                @endif
            </div>
        </div>

        <div class="form-group required{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class=" control-label">{{ trans('registration.password') }}</label>

            <div>
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                @endif
            </div>
        </div>

        <div class="form-group required{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('registration.password_confirmation') }}</label>

            <div>
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="mt-md">
                <button type="submit" class="btn btn-primary btn-full-width">
                    {{ trans('registration.register') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
