@extends('app')
@section('meta_title', trans('login.login_title'))

@section('content')

<div class="col-lg-6 center-block"  style="float: none;">
<h1>Вход</h1>
    <div class="row">
        <p>{{ trans('login.text_1') }}</p>
        <p>{{ trans('login.text_2') }}</p>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('login.login') }}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('login.email') }}</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('login.password') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> {{ trans('login.remember_me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> {{ trans('login.login') }}
                            </button>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ trans('login.forgot_password') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
