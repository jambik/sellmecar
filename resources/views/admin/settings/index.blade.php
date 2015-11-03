@extends('admin.page', ['title' => "Администрирование - Настройки - Sellmecar"])

@section('content')

    <h1 class="text-center">Настройки</h1>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
            {!! Form::model($settings, ['url' => route('admin.settings.save'), 'method' => 'POST', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email Администратора:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Описание сайта:') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Сохранить настройки', ['class' => 'form-control btn btn-primary']) !!}
                </div>

                <div class="form-group">
                    <a href="{{ route('admin') }}" class="btn btn-block btn-default">Отмена</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
