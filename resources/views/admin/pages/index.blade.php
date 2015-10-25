@extends('admin.page', ['title' => "Администрирование - Новости - Sellmecar"])

@section('content')
    <h1 class="text-center">Страницы</h1>
    <p><a href="{{ route('admin.pages.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Добавить</a></p>

    <div class="table-responsive">
        <table id="table_items">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Название</th>
                    <th>Текст новости</th>
                    <th class="td-edit filter-false" data-sorter="false"><i class="fa fa-edit text-primary"></i></th>
                    <th class="td-delete filter-false" data-sorter="false"><i class="fa fa-remove text-danger"></i></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="5" class="pager">
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
                        <td>{{ $item->title }}</td>
                        <td>{{ str_limit(strip_tags($item->text), 300) }}</td>
                        <td><a href="{{ route('admin.pages.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::open(['url' => route('admin.pages.destroy', $item->id), 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы действительно хотите удалить запись #{{ $item->id }}');"><i class="fa fa-remove"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
