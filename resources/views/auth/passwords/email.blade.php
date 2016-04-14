@extends('app')

@section('meta_title', trans('passwords.reset_title'))


<!-- Main Content -->
@section('content')

<div class="col-lg-6 center-block"  style="float: none;">
<h1>{{ trans('passwords.reset_title') }}</h1>
    <div class="row">
    <p>{{ trans('passwords.enter_your_email') }}</p>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('passwords.password_recovery') }}</div>
            <div class="panel-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">{{ trans('passwords.email') }}</label>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope"></i> {{ trans('passwords.send_link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
