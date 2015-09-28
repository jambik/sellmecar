@extends('admin.page', ['title' => "Администрирование - Новости - Sellmecar"])

@section('content')
	<h1 class="text-center">Новости</h1>
	<p>
		<a href="{{ route('admin.news.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a>
	</p>
	<table class="table table-responsive table-striped table-bordered" id="table_items">
		<thead>
			<tr>
				<th>Id</th>
				<th>Фото</th>
                <th>Заголовок</th>
				<th>Текст новости</th>
				<th class="order-default order-direction-desc">Дата публикации</th>
				<th class="td-edit"><i class="fa fa-edit text-primary"></i></th>
				<th class="td-delete"><i class="fa fa-remove text-danger"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>{{ $item->id }}</td>
                    <td>@if ($item->image)<img src='{{ $item->img_url.$item->image.$item->img_size['icon'] }}' alt='' />@endif</td>
					<td>{{ $item->title }}</td>
					<td>{{ str_limit(strip_tags($item->text), 300) }}</td>
                    <td>{{ $item->published_at }}</td>
					<td><a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
					<td>
						{!! Form::open(['url' => route('admin.news.destroy', $item->id), 'method' => 'DELETE']) !!}
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы действительно хотите удалить запись #{{ $item->id }}');"><i class="fa fa-remove"></i></button>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
