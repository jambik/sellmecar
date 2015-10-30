<div class="form-group">
    {!! Form::label('title', 'Заголовок новости:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('text', 'Текст новости:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control input-html', 'rows' => 3]) !!}
</div>

<div class="form-group">
    {!! Form::label('published_at', 'Дата публикации:') !!}
    {!! Form::text('published_at', null, ['class' => 'form-control input-datetime', 'rows' => 3]) !!}
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
	<a href="{{ route('admin.news.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>