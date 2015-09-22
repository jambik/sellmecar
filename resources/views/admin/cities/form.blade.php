<div class="form-group">
    {!! Form::label('name', 'Город:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.cities.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>