<div class="form-group">
    {!! Form::label('name', 'Имя:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Пароль:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
    @if (isset($item)) <small>Если оставить пароль пустым, то он не изменится</small> @endif
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.administrators.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>