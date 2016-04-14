<div class="form-group">
    {!! Form::label('Ф.И.О.') !!}
    {!! Form::text('fio', null, array('placeholder'=>'Иванов Иван Иванович', 'class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('Организация') !!}
    {!! Form::text('organisation', null, array('placeholder'=>'ООО Технопоиск', 'class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('E-mail') !!}
    {!! Form::text('email', null, array('placeholder'=>'ivanov@mail.ru', 'class' => 'form-control')) !!}
</div>


<div class="form-group">
    {!! Form::label('Пароль') !!}
    {!! Form::password('password', array('placeholder'=>'', 'class' => 'form-control')) !!}
</div>


<div class="form-group">
    {!! Form::label('Подтверждение пароля') !!}
    {!! Form::password('password_confirmation', array('placeholder'=>'', 'class' => 'form-control')) !!}
</div>

@if(Auth::user()->isAdmin)
<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('isModerator', '0') !!}
            {!! Form::checkbox('isModerator', 1) !!} <b>Модератор</b>
        </label>
    </div>
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('isAdmin', '0') !!}
            {!! Form::checkbox('isAdmin', 1) !!} <b>Администратор</b>
        </label>
    </div>
</div>

@endif

<div class="form-group">
    <div class="checkbox">
        <label>
            {!! Form::hidden('canAccess', '0') !!}
            {!! Form::checkbox('canAccess', 1) !!} <b>Может просматривать контент</b>
        </label>
    </div>
</div>