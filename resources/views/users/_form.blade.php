<div class="form-group">
    {!! Form::label(trans('users.fio')) !!}
    {!! Form::text('fio', null, array('placeholder'=>trans('users.fio_placeholder'), 'class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label(trans('users.organisation')) !!}
    {!! Form::text('organisation', null, array('placeholder'=> trans('users.organisation_placeholder'), 'class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('E-mail') !!}
    {!! Form::text('email', null, array('placeholder'=>'ivanov@mail.ru', 'class' => 'form-control')) !!}
</div>


<div class="form-group">
    {!! Form::label(trans('users.password')) !!}
    {!! Form::password('password', array('placeholder'=>'', 'class' => 'form-control')) !!}
</div>


<div class="form-group">
    {!! Form::label(trans('users.password_confirm')) !!}
    {!! Form::password('password_confirmation', array('placeholder'=>'', 'class' => 'form-control')) !!}
</div>

@if(Auth::user()->isAdmin)
<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('isModerator', '0') !!}
            {!! Form::checkbox('isModerator', 1) !!} <b>{{ trans('users.moderator') }}</b>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('isAdmin', '0') !!}
            {!! Form::checkbox('isAdmin', 1) !!} <b>{{ trans('users.administrator') }}</b>
        </label>
    </div>
</div>

@endif

<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('canAccess', '0') !!}
            {!! Form::checkbox('canAccess', 1) !!} <b>{{ trans('users.can_access') }}</b>
        </label>
    </div>
</div>