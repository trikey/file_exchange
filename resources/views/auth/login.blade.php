@extends('app')
@section('meta_title', trans('login.login_title'))

@section('content')

<div class="auth-form center-block">
    <ul class="nav nav-pills auth-nav">
        <li role="presentation" class="active"><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
        <li role="presentation"><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
    </ul>
    <form  method="POST" action="{{ url('/login') }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('login.email') }}</label>

            <div>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" data-toggle="popover"
                       data-placement="right" data-trigger="focus"
                       data-content="{{ trans('login.text_1') }} {{ trans('login.text_2') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label">{{ trans('login.password') }}</label>
            <div>
                <input type="password" class="form-control" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

<!--        <div class="form-group">-->
<!--            <div>-->
<!--                <div class="checkbox">-->
<!--                    <label>-->
<!--                        <input type="checkbox" name="remember"> {{ trans('login.remember_me') }}-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="form-group">
            <div class="mt-md">
                <button type="submit" class="btn btn-primary btn-full-width">
                    {{ trans('login.login') }}
                </button>
            </div>
        </div>
        <div class="forgot-pass-block">
            <div class="center-text">
                <a class="gray-link" href="{{ url('/password/reset') }}">{{ trans('login.forgot_password') }}</a>
            </div>
        </div>
    </form>
</div>
@endsection
