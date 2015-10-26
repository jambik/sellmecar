<div class="form-group">
    {!! Form::label('alias', 'Alias:') !!}
    {!! Form::text('alias', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('title', 'Название:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('text', 'Текст:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control input-html', 'rows' => 3]) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.blocks.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>