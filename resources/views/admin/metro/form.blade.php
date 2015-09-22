<div class="form-group">
    {!! Form::label('name', 'Название метро:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('city_id', 'Город:') !!}
    {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.metro.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>