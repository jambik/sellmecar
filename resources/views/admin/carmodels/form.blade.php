<div class="form-group">
    {!! Form::label('name', 'Модель авто:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('car_id', 'Авто:') !!}
    {!! Form::select('car_id', $cars, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.carmodels.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>