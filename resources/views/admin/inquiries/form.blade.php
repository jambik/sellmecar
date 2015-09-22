<div class="form-group">
    {!! Form::label('car_id', 'Автомобиль:') !!}
    {!! Form::select('car_id', [0 => ''] + $cars, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('model', 'Модель:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('transmission', 'Трансмиссия:') !!}
    {!! Form::select('transmission', ['1' => 'Автомат', 2 => 'Механика', 0 => 'Не важно'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('year_from', 'Год - c:') !!}
    {!! Form::text('year_from', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('year_to', 'Год - по:') !!}
    {!! Form::text('year_to', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price_from', 'Цена - от:') !!}
    {!! Form::text('price_from', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('price_to', 'Цена - до:') !!}
    {!! Form::text('price_to', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('city', 'Город:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('metro', 'Метро:') !!}
    {!! Form::text('metro', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Имя:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Телефон:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('information', 'Дополнительная информация:') !!}
    {!! Form::textarea('information', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

{!! Form::hidden('user_id', isset($item) ? $item->user_id : Auth::user()->id) !!}

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.inquiries.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>