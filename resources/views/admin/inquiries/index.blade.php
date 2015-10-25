@extends('admin.page', ['title' => "Администрирование - Пользователи - Sellmecar"])

@section('content')
	<h1 class="text-center">Объявления</h1>
	<p>
		<a href="{{ route('admin.inquiries.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
	</p>
	<table class="table table-responsive table-striped table-bordered" id="table_items2" data-sortlist="[[0,0]]">
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
				<th class="td-edit" data-sorter="false"><i class="fa fa-edit text-primary"></i></th>
				<th class="td-delete" data-sorter="false"><i class="fa fa-remove text-danger"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $item->car->name }}{{ $item->model ? ', '.$item->model : '' }}</td>
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

    <div id="pager" class="pager">
        <form>
            <input type="button" value="&lt;&lt;" class="first" />
            <input type="button" value="&lt;" class="prev" />
            <input type="text" class="pagedisplay"/>
            <input type="button" value="&gt;" class="next" />
            <input type="button" value="&gt;&gt;" class="last" />
            <select class="pagesize">
                <option selected="selected" value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
        </form>
    </div>
@endsection
