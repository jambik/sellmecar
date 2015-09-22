<div class="form-group">
    {!! Form::label('name', 'Автомобиль:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('image', 'Фото:') !!}
    {!! Form::file('image', ['class' => 'form-control']) !!}
</div>

@if (isset($item) && $item->image)
    <img src="{{ $item->img_url.$item->image.$item->img_size['thumb'] }}" alt="" />
    <p>&nbsp;</p>
@endif

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.cars.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>