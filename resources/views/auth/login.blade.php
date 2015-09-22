@include('partials._header', ['title' => 'Sellmecar - Вход'])

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Вход</div>
                <div class="panel-body">
                    @include('partials._errors')
                    @include('partials._status')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail адрес</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Пароль</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Вход</button>

                                <a class="btn btn-link" href="{{ url('/password/email') }}">Забыл пароль</a>
                            </div>
                        </div>

                        <div>&nbsp;</div>
                        <p class="text-right"><a class="btn btn-link" href="{{ url('/auth/register') }}">Регистрация</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials._footer')