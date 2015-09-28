@extends('admin.page', ['title' => "Администрирование - Пользователи - Sellmecar"])

@section('content')
	<h1 class="text-center">Объявления</h1>
	<p>
		<a href="{{ route('admin.inquiries.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
	</p>
	<table class="table table-responsive table-striped table-bordered" id="table_items">
		<thead>
			<tr>
				<th>Id</th>
				<th>Автомобиль</th>
				<th>Года</th>
				<th>Цена</th>
                <th>Адрес</th>
				<th>Контакты</th>
                <th>Доп. информация</th>
				<th class="order-default order-direction-desc">Дата объявления</th>
				<th class="td-edit"><i class="fa fa-edit text-primary"></i></th>
				<th class="td-delete"><i class="fa fa-remove text-danger"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>
                        {{ $item->car->name }}{{ $item->model ? ', '.$item->model : '' }}
                        <div>трансииссия: {{ $item->transmission_name }}</div>
                    </td>
                    <td>{{ $item->year_from ? 'с '.$item->year_from.'г. ' : '' }}{{ $item->year_to ? 'по '.$item->year_to.'г. ' : '' }}{{ !$item->year_from && !$item->year_to ? '-' : '' }}</td>
					<td>{{ $item->price_from ? 'от '.$item->price_from_formatted.'руб. ' : '' }}{{ $item->price_to ? 'до '.$item->price_to_formatted.'руб. ' : '' }}{{ !$item->price_from && !$item->price_to ? '-' : '' }}</td>
					<td>г. {{ $item->city->name }}{{ $item->metro ? ', метро '.$item->metro : '' }}{{ $item->street ? ', '.$item->street : '' }}</td>
					<td>{{ $item->name }}{{ $item->email ? ', email - '.$item->email : '' }}{{ $item->phone ? ', телефон - '.$item->phone : '' }}</td>
                    <td>{{ $item->information ?: '-' }}</td>
                    <td>{{ $item->created_at }}</td>
					<td><a href="{{ route('admin.inquiries.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
					<td>
						{!! Form::open(['url' => route('admin.inquiries.destroy', $item->id), 'method' => 'DELETE']) !!}
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы действительно хотите удалить запись #{{ $item->id }}');"><i class="fa fa-remove"></i></button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
