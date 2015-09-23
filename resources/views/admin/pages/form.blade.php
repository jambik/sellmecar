<div class="form-group">
    {!! Form::label('title', 'Название:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('text', 'Текст страницы:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.pages.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>