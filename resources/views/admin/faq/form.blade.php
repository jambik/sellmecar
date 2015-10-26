<div class="form-group">
    {!! Form::label('question', 'Вопрос:') !!}
    {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('answer', 'Ответ:') !!}
    {!! Form::textarea('answer', null, ['class' => 'form-control input-html', 'rows' => 3]) !!}
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'form-control btn btn-primary']) !!}
</div>

<div class="form-group">
	<a href="{{ route('admin.faq.index') }}" class="btn btn-block btn-default">Отмена</a>
</div>