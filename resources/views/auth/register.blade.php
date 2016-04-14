@extends('app')

@section('meta_title', trans('registration.meta_title'))


@section('content')
<div class="col-lg-6 center-block"  style="float: none;">
<h1>{{ trans('registration.meta_title') }}</h1>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('registration.registration') }}</div>
            <div class="panel-body">
                <p class="text-info">{{ trans('registration.all_fields_are_required') }}</p>

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {!! csrf_field() !!}

                    <div class="form-group required{{ $errors->has('fio') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('registration.fio') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="fio" value="{{ old('fio') }}">

                            @if ($errors->has('fio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group required{{ $errors->has('organisation') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('registration.organisation') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="organisation" value="{{ old('organisation') }}">

                            @if ($errors->has('organisation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('organisation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('registration.email') }}</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('registration.password') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group required{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('registration.password_confirmation') }}</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> {{ trans('registration.register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
