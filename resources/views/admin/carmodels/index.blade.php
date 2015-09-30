@extends('admin.page', ['title' => "Администрирование - Модели авто - Sellmecar"])

@section('content')
	<h1 class="text-center">Метро</h1>
	<p>
		<a href="{{ route('admin.carmodels.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
	</p>
	<table class="table table-responsive table-striped table-bordered" id="table_items">
		<thead>
			<tr>
				<th>Id</th>
				<th>Модель авто</th>
				<th class="order-default">Авто</th>
				<th class="td-edit"><i class="fa fa-edit text-primary"></i></th>
				<th class="td-delete"><i class="fa fa-remove text-danger"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
					<td>{{ $item->name }}</td>
					<td>{{ $item->car->name }}</td>
					<td><a href="{{ route('admin.carmodels.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
					<td>
						{!! Form::open(['url' => route('admin.carmodels.destroy', $item->id), 'method' => 'DELETE']) !!}
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы действительно хотите удалить запись #{{ $item->id }}');"><i class="fa fa-remove"></i></button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
