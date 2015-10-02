<div class="form-group">
    {!! Form::label('car_id', 'Автомобиль:') !!}
    {!! Form::select('car_id', $cars, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('model', 'Модель:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
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
    {!! Form::label('city_id', 'Город:') !!}
    {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
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

<hr>

<h4 class="text-center">Расришенная информация</h4>

<div class="form-group">
{!! Form::label('carinfo[gear]', 'Привод:') !!}
{!! Form::select('carinfo[gear]', ['0' => '- Привод -'] + config('vars.car_info.gear'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[transmission]', 'Трансмиссия:') !!}
    {!! Form::select('carinfo[transmission]', ['0' => '- Трансмиссия -'] + config('vars.car_info.transmission'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[engine]', 'Тип двигателя:') !!}
    {!! Form::select('carinfo[engine]', ['0' => '- Тип двигателя -'] + config('vars.car_info.engine'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[rudder]', 'Руль:') !!}
    {!! Form::select('carinfo[rudder]', ['0' => '- Руль -'] + config('vars.car_info.rudder'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[color]', 'Цвет:') !!}
    {!! Form::select('carinfo[color]', ['0' => '- Цвет -'] + $colors, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[capacity_from]', 'Объем двигателя от, л.:') !!}
    {!! Form::select('carinfo[capacity_from]', ['0' => '- Объем двигателя от -'] + config('vars.car_info.capacity'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[capacity_to]', 'Объем двигателя до, л.:') !!}
    {!! Form::select('carinfo[capacity_to]', ['0' => '- Объем двигателя до -'] + config('vars.car_info.capacity'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[state]', 'Состояние авто:') !!}
    {!! Form::select('carinfo[state]', ['0' => '- Состояние авто -'] + config('vars.car_info.state'), null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('carinfo[owners]', 'Количество хозяев по ПТС:') !!}
    {!! Form::select('carinfo[owners]', ['0' => '- Привод -'] + config('vars.car_info.owners'), null, ['class' => 'form-control']) !!}
</div>


{!! Form::hidden('user_id', isset($item) ? $item->user_id : Auth::user()->id) !!}

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.inquiries.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>