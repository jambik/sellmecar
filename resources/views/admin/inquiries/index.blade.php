@extends('admin.page', ['title' => "Администрирование - Пользователи - Sellmecar"])

@section('content')
    <h1 class="text-center">Объявления</h1>
    <p><a href="{{ route('admin.inquiries.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a></p>

    <div class="table-responsive">
        <table id="table_items" data-sortlist="[[7,1]]">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Автомобиль</th>
                    <th>Года</th>
                    <th>Цена</th>
                    <th>Адрес</th>
                    <th>Контакты</th>
                    <th>Доп. информация</th>
                    <th>Дата объявления</th>
                    <th class="td-edit filter-false" data-sorter="false"><i class="fa fa-edit text-primary"></i></th>
                    <th class="td-delete filter-false" data-sorter="false"><i class="fa fa-remove text-danger"></i></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="10" class="pager">
                        <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                        <select class="pagesize form-control" title="Размер страницы">
                            <option selected="selected" value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                        </select>
                        <select class="gotoPage form-control" title="Номер страницы"></select>
                    </th>
                </tr>
            </tfoot>
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
    </div>
@endsection
