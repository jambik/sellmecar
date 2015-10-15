@include('partials._header', ['title' => 'Sellmecar - главная'])

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="img/logo.png" class="img-responsive" alt="">
                <span class="slogan">Мечта сама приедет к Вам</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Главная</a></li>
                <li><a href="#" onclick="$('body').scrollTo('#section_inquiries', 500); return false;">Объявления</a></li>
                <li><a href="#" onclick="$('body').scrollTo('#section_apply', 500); return false;">Покупателям</a></li>
                <li><a href="#" onclick="$('body').scrollTo('#section_search', 500); return false;">Продавцам</a></li>
                <li><a href="#" onclick="$('body').scrollTo('#section_news', 500); return false;">Новости</a></li>
                <li id="login_menu" style="display: {{ Auth::check() ? 'none' : 'inline-block' }}">
                    <a href="#" class="dropdown-toggle login-link" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Вход <span class="caret"></span></a>
                    <div class="dropdown-menu" role="menu" aria-labelledby="dropdownLogin">
                        <div class="login-popup">
                            <form action="/auth/login" method="POST" accept-charset="UTF-8" id="form_login">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Пароль" class="form-control" />
                                </div>
                                <div class="form-group text-center">
                                    <div class="checkbox">
                                        <input type="checkbox" name="remember"> Запомнить меня
                                    </div>
                                </div>
                                {!! Form::token() !!}
                                <button type="submit" class="btn btn-block btn-warning">Вход</button>
                                <div>&nbsp;</div>
                                <div class="text-center">
                                    <a href="/password/email" id="email_link">Забыл проль?</a>
                                </div>
                            </form>
                            <hr />
                            <div class="social-buttons">
                                <p class="text-center"><strong>Вход через социальные сети:</strong></p>
                                <a href="/auth/facebook"><img src="img/social2/FB.png"></a>
                                <a href="/auth/vkontakte"><img src="img/social2/VK.png"></a>
                                <a href="/auth/twitter"><img src="img/social2/Twitter.png"></a>
                                <a href="/auth/odnoklassniki"><img src="img/social2/Odnoklasniki.png"></a>
                                <a href="/auth/yandex"><img src="img/social2/ya.png"></a>
                                <a href="/auth/google"><img src="img/social2/G.png"></a>
                            </div>
                            <hr />
                            <div class="text-center"><a href="/auth/register">Регистрация на сайте</a></div>
                        </div>
                    </div>
                </li>
                <li id="user_menu" style="display: {{ Auth::check() ? 'inline-block' : 'none' }};">
                    <div class="dropdown user-links">
                        <a href="#" class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-expanded="true"><img src="{{ Auth::check() && Auth::user()->avatar ? Auth::user()->avatar : '/img/avatar.png' }}"><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#profileModal" v-on="click: profileLoad"><i class="fa fa-user"></i> Данные аккаунта</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#inquiriesModal" v-on="click: inquiriesLoad"><i class="fa fa-list"></i> Мои объявления</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/auth/logout"><i class="fa fa-sign-out"></i> Выход</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="section_apply">
    <div>&nbsp;</div>

    {{--Шаг 0: Баннер--}}
    <div class="container" id="container_step0" style="display: {{ !Request::has('step') || Request::get('step') == 0 ? 'block' : 'none' }};">
        <div class="hidden-xs">&nbsp;</div>
        <div class="text-light text-xl text-shadow text-center hidden-xs text-uppercase">Как дать объявление на покупку автомобиля</div>
        <div class="hidden-xs">&nbsp;</div>
        <div class="hidden-xs">&nbsp;</div>
        <div class="row hidden-xs">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card" v-on="click: showCard(1)">
                    <div class="card-inner step-1">
                        <div>Регистрация на сайте</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card" v-on="click: showCard(2)">
                    <div class="card-inner step-2">
                        <div>Какое авто хочу купить</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card" v-on="click: showCard(3)">
                    <div class="card-inner step-3">
                        <div>Продавец авто приедет к вам сам на осмотр</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="card" v-on="click: showCard(4)">
                    <div class="card-inner step-4">
                        <div>Вы новый хозяин авто</div>
                    </div>
                </div>
            </div>
        </div>

        <div>&nbsp;</div>

        <p class="text-shadow text-light text-about">Уникальность нашего сайта состоит в том, что покупатель выставляет свое объявление, а продавец автомобиля  ищет именно то, объявление, где есть сходство с его автомобилем!</p>

        <div class="hidden-xs">&nbsp;</div>
        <div>&nbsp;</div>
        <div class="btn-line">
            <button class="btn btn-danger" id="btn_inquiry_create"><span class="fa fa-list-alt btn-icon"></span> Дать объявление</button>
        </div>
        <div class="hidden-xs">&nbsp;</div>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 0/--}}



    {{--Шаг 1: Регистрация--}}
    <div class="container" id="container_step1" style="display: {{ Request::has('step') && Request::get('step') == 1 ? 'block' : 'none' }};">
        <div>&nbsp;</div>
        <div class="text-light text-xl text-shadow text-center text-uppercase">Регистрация</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-1 col-md-offset-1">
                <form action="/auth/register" method="POST" accept-charset="UTF-8" class="form-ajax" id="form_register" v-on="submit: ajaxFormSubmit($event, registrationSuccess)">
                    <div class="form-status"></div>
                    <div class="form-group has-feedback">
                        <input type="text" name="name" placeholder="Имя" class="form-control" aria-describedby="nameRequired">
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                        <span id="nameRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" placeholder="Email" class="form-control" aria-describedby="emailRequired">
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                        <span id="emailRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" placeholder="Пароль" class="form-control" aria-describedby="passwordRequired">
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                        <span id="passwordRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation" placeholder="Пароль еще раз" class="form-control" aria-describedby="passwordConfirmationRequired">
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" aria-hidden="true"></span>
                        <span id="passwordConfirmationRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <hr>
                    {!! Form::token() !!}
                    <button class="btn btn-block btn-success form-button">Регистрация</button>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-1 col-md-offset-1 login-social">
                <div class="text-xl text-light text-center text-shadow">Войти через соцсети</div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/facebook"><img src="img/social2/FB.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/vkontakte"><img src="img/social2/VK.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/twitter"><img src="img/social2/Twitter.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/odnoklassniki"><img src="img/social2/Odnoklasniki.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/yandex"><img src="img/social2/ya.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center"><a href="/auth/google"><img src="img/social2/G.png"></a></div>
                </div>
            </div>
        </div>

        <div>&nbsp;</div>
        <div class="hidden-xs">&nbsp;</div>
        <div class="hidden-xs">&nbsp;</div>
        <div class="btn-line">
            <button id="btn_back_start" class="btn btn-danger"><span class="fa fa-arrow-circle-o-left btn-icon"></span> Назад</button>
        </div>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 1/--}}

    {{--Шаг 2: Дать объявление--}}
    <div class="container" id="container_step2" style="display: {{ Request::has('step') && Request::get('step') == 2 ? 'block' : 'none' }};">
        <div>&nbsp;</div>
        <div class="text-light text-xxl text-shadow text-center">Дать объявление</div>
        <div>&nbsp;</div>
        <form action="{{ route('inquiryStore') }}" method="POST" accept-charset="UTF-8" id="form_inquiry" class="form-ajax" v-on="submit: ajaxFormSubmit($event, inquiryCreateSuccess)">
            <div class="form-status" data-error-text="Ваше объявление не может быть создано, потому что вы не заполнили следующие обязательные поля:"></div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                    <div class="form-group has-feedback">
                        <label>Автомобиль:</label>
                        <select name="car_id" placeholder="- Выберите марку автомобиля -" class="form-control" aria-describedby="carRequired" v-model="car" v-on="change: changeCar">
                            <option value="">- Выберите марку автомобиля -</option>
                            @foreach($cars as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" style="padding-right: 15px;" aria-hidden="true"></span>
                        <span id="carRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Модель авто:</label>
                            <select name="model" class="form-control select2" v-model="model" options="modelOptions">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label>Цена, от:</label>
                            <input type="text" name="price_from" class="form-control mask-price" onblur="if( parseInt($(this).parent().next().find('input').val()) && parseInt($(this).parent().next().find('input').val()) < parseInt($(this).val()) ) $(this).parent().next().find('input').val( $(this).val() ); $(this).parent().next().find('input').addClass('animated jello');" placeholder="цена от">
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label>до:</label>
                            <input type="text" name="price_to" class="form-control mask-price" onblur="if( parseInt($(this).parent().prev().find('input').val()) && parseInt($(this).parent().prev().find('input').val()) > parseInt($(this).val()) ) $(this).parent().prev().find('input').val( $(this).val() ); $(this).parent().prev().find('input').addClass('animated jello');" placeholder="цена до">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <label>Год выпуска, от:</label>
                            <input type="text" name="year_from" class="form-control input-year" onblur="console.log(parseInt($(this).parent().next().find('input').val())); if( parseInt($(this).parent().next().find('input').val()) && parseInt($(this).parent().next().find('input').val()) < parseInt($(this).val()) ) $(this).parent().next().find('input').val( $(this).val() ); $(this).parent().next().find('input').addClass('animated jello');" placeholder="год от">
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <label>до:</label>
                            <input type="text" name="year_to" class="form-control input-year" onblur="if( parseInt($(this).parent().prev().find('input').val()) && parseInt($(this).parent().prev().find('input').val()) > parseInt($(this).val()) ) $(this).parent().prev().find('input').val( $(this).val() ); $(this).parent().prev().find('input').addClass('animated jello');" placeholder="год до">
                        </div>
                    </div>

                    <div class="row">
                        <div>&nbsp;</div>
                        <div class="text-center info-link">
                            <a href="#" v-on="click: showAdditional($event)">Ввести дополнительные данные</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="form-group has-feedback">
                        <label>Город:</label>
                        <select name="city_id" placeholder="- Выберите город -" class="form-control" aria-describedby="cityRequired" v-model="city" v-on="change: changeCity">
                            <option value="">- Выберите город -</option>
                            @foreach($cities as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <span class="glyphicon glyphicon-asterisk form-control-feedback" style="padding-right: 15px;" aria-hidden="true"></span>
                        <span id="cityRequired" class="sr-only">(обязательно)</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group" v-show="metroOptions.length">
                                <label for="metro">Метро:</label>
                                <select name="metro" class="form-control select2" v-model="metro" options="metroOptions">
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="street">Улица:</label>
                                <input type="text" name="street" id="street" class="form-control" v-model="street">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" name="name" class="form-control" v-model="user.name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="phone">Телефон:</label>
                                <input type="text" name="phone" class="form-control" v-model="user.phone ? user.phone : '+7'">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('information', 'Дополнительная информация:') !!}
                        {!! Form::textarea('information', null, ['class' => 'form-control', 'rows' => 4, 'style' => 'height: 100px;', 'placeholder' => 'Например: хочу машину белого цвета, не битую']) !!}
                    </div>
                </div>
            </div>

            <div class="row" v-show="showAdditionalFields" v-transition="flipInX">
                <div>&nbsp;</div>
                <p class="lead text-center text-light">Дополнительные характеристики авто</p>

                <div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[gear]" placeholder="- Привод -" class="form-control">
                                <option value="0">- Привод -</option>
                                @foreach (config('vars.car_info.gear') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[transmission]" placeholder="- Трансмиссия -" class="form-control">
                                <option value="0">- Трансмиссия -</option>
                                @foreach (config('vars.car_info.transmission') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[engine]" placeholder="- Тип двигателя -" class="form-control">
                                <option value="0">- Тип двигателя -</option>
                                @foreach (config('vars.car_info.engine') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[rudder]" placeholder="- Руль -" class="form-control">
                                <option value="0">- Руль -</option>
                                @foreach (config('vars.car_info.rudder') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[color]" placeholder="- Цвет -" class="form-control select2-color">
                                <option value="0">- Цвет -</option>
                                @foreach (config('vars.car_info.color') as $value)
                                    <option value="{{ $value['name'] }}" data-hex="{{ $value['hex'] }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <input type="text" name="run" placeholder="Пробег до, км" class="form-control mask-km">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[capacity_from]" placeholder="- Объем двигателя от, л. -" class="form-control">
                                <option value="0">- Объем двигателя от, л. -</option>
                                @foreach (config('vars.car_info.capacity') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} л.</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[capacity_to]" placeholder="- Объем двигателя до, л. -" class="form-control">
                                <option value="0">- Объем двигателя до, л. -</option>
                                @foreach (config('vars.car_info.capacity') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} л.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[state]" placeholder="- Состояние авто -" class="form-control">
                                <option value="0">- Состояние авто -</option>
                                @foreach (config('vars.car_info.state') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                            <select name="carinfo[owners]" placeholder="- Количество хозяев по ПТС -" class="form-control">
                                <option value="0">- Количество хозяев по ПТС -</option>
                                @foreach (config('vars.car_info.owners') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div>&nbsp;</div>

            <div class="btn-line">
                <button type="submit" class="btn btn-danger form-button"><span class="fa fa-check-square-o btn-icon"></span> Опубликовать объявление</button>
            </div>
            {!! Form::token() !!}
        </form>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 2/--}}



    {{--Шаг 3: Просмотр объявления--}}
    <div class="container" id="container_step3" style="display: {{ Request::has('step') && Request::get('step') == 3 ? 'block' : 'none' }};">
        <div>&nbsp;</div>

        <div class="text-light text-xl text-shadow text-center text-uppercase">Мое объявление</div>
        <div>&nbsp;</div>
        <div class="text-light text-l text-shadow text-center">Уважаемый (ая): @{{ inquiryCreated.name }}, Ваше объявление размещено под номером: <span class="inquiry-new-id">@{{ inquiryCreated.id }}</span></div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 inquiry_new">
                <div class="caption">Параметры объявления:</div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">Автомобиль:</div>
                    <div class="col-lg-6">
                        @{{  inquiryCreated.car.name }}
                        <span v-if="inquiryCreated.model">, @{{ inquiryCreated.model }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">Год выпуска:</div>
                    <div class="col-lg-6">
                        <span v-if="inquiryCreated.year_from">с @{{ inquiryCreated.year_from }}г.</span>
                        <span v-if="inquiryCreated.year_to">по @{{ inquiryCreated.year_to }}г.</span>
                        <span v-if="! inquiryCreated.year_from && ! inquiryCreated.year_to">-</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">Стоимость:</div>
                    <div class="col-lg-6">
                        <span v-if="inquiryCreated.price_from">от @{{ inquiryCreated.price_from_formatted }}руб.</span>
                        <span v-if="inquiryCreated.price_to">до @{{ inquiryCreated.price_to_formatted }}руб.</span>
                        <span v-if="! inquiryCreated.price_from && ! inquiryCreated.price_to">-</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">Место проживания:</div>
                    <div class="col-lg-6">
                        <span>@{{ inquiryCreated.city.name }}</span>
                        <span v-if="inquiryCreated.metro">, метро @{{ inquiryCreated.metro }}</span>
                        <span v-if="inquiryCreated.street">, @{{ inquiryCreated.street }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">Дополнительная информация:</div>
                    <div class="col-lg-6">
                        <span v-if="inquiryCreated.information">@{{ inquiryCreated.information }}</span>
                        <span v-if="! inquiryCreated.information">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--/Шаг 3/--}}




    <div>&nbsp;</div>
</section>

<section id="section_search">
    <div class="container">
        <div>&nbsp;</div>
        <div class="hidden-xs">&nbsp;</div>
        <div class="text-dark text-xxl text-uppercase text-center">Как продать свой автомобиль</div>
        <div>&nbsp;</div>
        <p class="text-center">Сначала выберите марку Вашего автомобиля (лей)</p>
        <div class="hidden-xs">&nbsp;</div>
        <form action="{{ route('inquirySearch') }}" accept-charset="UTF-8" method="POST" id="form_inquiry_search" class="form-ajax" v-on="submit: ajaxFormSubmit($event, inquirySearchSuccess)">
            <div class="form-status"></div>

            <div class="row brands hidden-xs">
                @for ($i = 0; ($i < $carBrandsShow && $i < $cars->count()); $i++)
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 brand-item">
                        <label>
                            <div class="car-image">@if($cars[$i]->image) <img src='{{ $cars[$i]->img_url.$cars[$i]->image.$cars[$i]->img_size['xs'] }}'> @endif</div>
                            <div class="brand-name"><input type="checkbox" name="car_id[]" v-on="change: selectCar($event, {{ $cars[$i]->id }})" value="{{ $cars[$i]->id }}" data-car-name="{{ $cars[$i]->name }}"> {{ $cars[$i]->name }} <span>{{ $cars[$i]->inquiriesCount ? "(".$cars[$i]->inquiriesCount.")" : '' }}</span></div>
                        </label>
                    </div>
                @endfor

                @if ($carBrandsShow < $cars->count())
                    <div class="more-brands text-center"><a href="#" onclick="$('.brands-hidden').show(); $('.brands-hidden').addClass('animated bounceIn'); $(this).hide(); return false;">Смотреть еще</a></div>

                    <div class="brands-hidden">
                        @for ($i = $carBrandsShow; ($i < $cars->count()); $i++)
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 brand-item">
                                <label>
                                    <div class="car-image">@if($cars[$i]->image) <img src='{{ $cars[$i]->img_url.$cars[$i]->image.$cars[$i]->img_size['xs'] }}'> @endif</div>
                                    <div class="brand-name"><input type="checkbox" name="car_id[]" v-on="change: selectCar($event, {{ $cars[$i]->id }})" value="{{ $cars[$i]->id }}" data-car-name="{{ $cars[$i]->name }}"> {{ $cars[$i]->name }} <span>{{ $cars[$i]->inquiriesCount ? "(".$cars[$i]->inquiriesCount.")" : '' }}</span></div>
                                </label>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>

            <div class="hidden-xs">&nbsp;</div>
            <div class="hr hidden-xs"></div>
            <div class="hidden-xs">&nbsp;</div>
            <div class="hidden-xs">&nbsp;</div>

            <p class="text-l text-uppercase text-center hidden-xs">Поиск объявлений по параметрам Вашего авто</p>
            <div>&nbsp;</div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group visible-xs-block">
                        <select name="car_id[]" placeholder="- Марка автомобиля -" class="form-control" v-on="change: selectCar($event)">
                            <option value="">- Марка автомобиля -</option>
                            @foreach ($cars as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="model" placeholder="- Модель автомобиля -" class="form-control select2" v-model="models" options="modelsOptions">
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="year_from" class="form-control input-year" onblur="if( parseInt($(this).parent().next().find('input').val()) && parseInt($(this).parent().next().find('input').val()) < parseInt($(this).val()) ) $(this).parent().next().find('input').val( $(this).val() ); $(this).parent().next().find('input').addClass('animated jello');" placeholder="год от">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="year_to" class="form-control input-year" onblur="if( parseInt($(this).parent().prev().find('input').val()) && parseInt($(this).parent().prev().find('input').val()) > parseInt($(this).val()) ) $(this).parent().prev().find('input').val( $(this).val() ); $(this).parent().prev().find('input').addClass('animated jello');" placeholder="год до">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <select name="city_id" placeholder="Выберите город" class="form-control" v-model="city" v-on="change: changeCity">
                            <option value="">- Выберите город -</option>
                            @foreach($cities as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="metro" data-placeholder="- Ближайшее метро -" class="form-control input-lg select2" v-model="metro" options="metroOptions" v-if="metroOptions.length">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row" id="search_car_info" v-show="showInquiryInfoFields" v-transition="flipInX">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="price_from" class="form-control mask-price" onblur="if( parseInt($(this).parent().next().find('input').val()) && parseInt($(this).parent().next().find('input').val()) < parseInt($(this).val()) ) $(this).parent().next().find('input').val( $(this).val() ); $(this).parent().next().find('input').addClass('animated jello');" placeholder="Цена, от">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="price_to" class="form-control mask-price" onblur="if( parseInt($(this).parent().prev().find('input').val()) && parseInt($(this).parent().prev().find('input').val()) > parseInt($(this).val()) ) $(this).parent().prev().find('input').val( $(this).val() ); $(this).parent().prev().find('input').addClass('animated jello');" placeholder="Цена, до">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="gear" placeholder="- Привод -" class="form-control">
                                <option value="0">- Привод -</option>
                                @foreach (config('vars.car_info.gear') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="transmission" placeholder="- Трансмиссия -" class="form-control">
                                <option value="0">- Трансмиссия -</option>
                                @foreach (config('vars.car_info.transmission') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="engine" placeholder="- Тип двигателя -" class="form-control">
                                <option value="0">- Тип двигателя -</option>
                                @foreach (config('vars.car_info.engine') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="rudder" placeholder="- Руль -" class="form-control">
                                <option value="0">- Руль -</option>
                                @foreach (config('vars.car_info.rudder') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="color" placeholder="- Цвет -" class="form-control select2-color">
                                <option value="0">- Цвет -</option>
                                @foreach (config('vars.car_info.color') as $value)
                                    <option value="{{ $value['name'] }}" data-hex="{{ $value['hex'] }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <input type="text" name="run" placeholder="Пробег до, км" class="form-control mask-km">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="capacity_from" placeholder="- Объем двигателя от, л. -" class="form-control">
                                <option value="0">- Объем двигателя от, л. -</option>
                                @foreach (config('vars.car_info.capacity') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} л.</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="capacity_to" placeholder="- Объем двигателя до, л. -" class="form-control">
                                <option value="0">- Объем двигателя до, л. -</option>
                                @foreach (config('vars.car_info.capacity') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} л.</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="capacity_from" placeholder="- Состояние авто -" class="form-control">
                                <option value="0">- Состояние авто -</option>
                                @foreach (config('vars.car_info.state') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <select name="capacity_to" placeholder="- Количество хозяев по ПТС -" class="form-control">
                                <option value="0">- Количество хозяев по ПТС -</option>
                                @foreach (config('vars.car_info.owners') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="search_info" value="1">
            </div>

            <div class="hidden-xs">&nbsp;</div>
            <div class="hidden-xs">&nbsp;</div>
            <div class="more-search text-center"><a href="#" v-on="click: showInquirySearchInfo($event)">Расширенный поиск</a></div>
            <div class="hidden-xs">&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>

            <div class="btn-line">
                <button class="btn btn-danger form-button"><span class="fa fa-search btn-icon"></span> Искать по параметрам</button>
            </div>
            <div>&nbsp;</div>
            {!! Form::token() !!}
        </form>
    </div>
</section>

<section id="section_search_results">
    <div class="container" v-show="inquiriesSearch">
        <div class="hidden-xs">&nbsp;</div>
        <h3 class="text-center text-uppercase">Результаты поиска</h3>

        <p class="text-center" v-if="inquiriesSearch.found.length">Найдено @{{ inquiriesSearch.found.length }} объявлений на покупку авто</p>
        <div>&nbsp;</div>

        <div class="table-responsive">
            <table class="table table-striped table-inquiries-found" id="table_inquiries_search">
                <thead>
                    <tr>
                        <th data-sorter="false">#</th>
                        <th data-sorter="false">&nbsp;</th>
                        <th>Марка</th>
                        <th>Модель</th>
                        <th>Года</th>
                        <th>Цена</th>
                        <th>Адрес</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-repeat="item in inquiriesSearch.found" class="inquiry-item" data-inquiry-id="@{{ item.id }}"  v-on="click: showInquiry($event)">
                        <td>#@{{ item.id }}</td>
                        <td><img v-attr='src: item.car.img_url + item.car.image + item.car.img_size["xs"]'></td>
                        <td>@{{ item.car.name }}</td>
                        <td>@{{ item.model }}</td>
                        <td>
                            <span v-if="item.year_from > 0">с @{{ item.year_from }}г.</span>
                            <span v-if="item.year_to > 0">по @{{ item.year_to }}г.</span>
                            <span v-if="item.year_from == 0 && item.year_to == 0">-</span>
                        </td>
                        <td>
                            <span v-if="item.price_from > 0">от @{{ item.price_from_formatted }}руб.</span>
                            <span v-if="item.price_to > 0">до @{{ item.price_to_formatted }}руб.</span>
                            <span v-if="item.price_from == 0 && item.price_to == 0">-</span>
                        </td>
                        <td>@{{ item.city.name }}<span v-if="item.metro">, метро @{{ item.metro }}</span><span v-if="item.street">, ул. @{{ item.street }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center" v-if=" ! inquiriesSearch.found.length">
            <p>По вашему запросу ничего не найдено</p>
            <p><a href="#section_search" onclick="$('body').scrollTo('#section_search', 500); return false;">вернуться к поиску</a></p>
        </div>

        <div class="hidden-xs">&nbsp;</div>
        <div class="hidden-xs">&nbsp;</div>
    </div>
</section>

<section id="section_inquiries">
    <div>&nbsp;</div>
    <div class="container">
        <div class="hidden-xs">&nbsp;</div>
        <div class="text-light text-xxl text-uppercase text-center">Последние объявления</div>
        <div class="hidden-xs">&nbsp;</div>
        <div>&nbsp;</div>

        <div class="row">
            @foreach ($lastInquiries as $item)
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="inquiry-block inquiry-item" data-inquiry-id="{{ $item->id }}">
                        @if($item->car->image)<div class="car-image"><img src='{{ $item->car->img_url.$item->car->image.$item->car->img_size['xs'] }}'></div>@endif
                        <div class="text-uppercase text-l">Куплю:</div>
                        <div class="block-line">автомобиль: <div class="value">{{ $item->car->name }}{{ $item->model ? ', '.$item->model : '' }}</div></div>
                        <div class="block-line">года: <div class="value">{{ $item->year_from ? 'с '.$item->year_from.'г. ' : '' }}{{ $item->year_to ? 'по '.$item->year_to.'г. ' : '' }}{{ $item->year_from && $item->year_to ? '' : '-' }}</div></div>
                        <div class="block-line">город: <div class="value">{{ $item->city->name }}</div></div>
                        <div>&nbsp;</div>
                        <a href="#" class="btn btn-block btn-success" v-on="click: showInquiry($event)">Подробнее</a>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" v-repeat="item in inquiriesLoaded" v-transition="bounceIn">
                <div class="inquiry-block inquiry-item" data-inquiry-id="@{{ item.id }}">
                    <div class="car-image" v-if="item.car.image"><img v-attr='src: item.car.img_url + item.car.image + item.car.img_size["xs"]'></div>
                    <div class="text-uppercase text-l">Куплю:</div>
                    <div class="block-line">
                        автомобиль:
                        <div class="value">
                            @{{ item.car.name }}<span v-if="item.model">, @{{ item.model }}</span>
                        </div>
                    </div>
                    <div class="block-line">
                        года:
                        <div class="value">
                            <span v-if="item.year_from > 0">с @{{ item.year_from }}г.</span>
                            <span v-if="item.year_to > 0">по @{{ item.year_to }}г.</span>
                            <span v-if="item.year_from == 0 && item.year_to == 0">-</span>
                        </div>
                    </div>
                    <div class="block-line">город: <div class="value">@{{ item.city.name }}</div></div>
                    <div>&nbsp;</div>
                    <a href="#" class="btn btn-block btn-success" v-on="click: showInquiry($event)">Подробнее</a>
                </div>
            </div>
        </div>
        @if ($lastInquiries->hasMorePages())
            <form action="{{ $lastInquiries->nextPageUrl() }}" accept-charset="UTF-8" method="GET" id="form_last_inquiries" v-on="submit: ajaxFormSubmit($event, loadInquiries)">
                <div class="btn-line">
                    <button type="submit" class="btn btn-danger form-button"><span class="fa fa-arrow-down btn-icon"></span> Ещё объявления</button>
                </div>
            </form>
        @endif
        <div>&nbsp;</div>
    </div>
    <div>&nbsp;</div>
</section>

<section id="section_news">
    <div class="container">
        <div class="hidden-xs">&nbsp;</div>
        <div class="text-dark text-xxl text-uppercase text-center">Новости</div>
        <div class="hidden-xs">&nbsp;</div>
        <div>&nbsp;</div>

        <div class="row">
            @foreach ($lastNews as $item)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="news-block" data-news-id="{{ $item->id }}">
                        <div class="news-date">{{ $item->published_at->diffForHumans() }}</div>
                        <div class="news-title"><a href="#" v-on="click: showNews($event)">{{ $item->title }}</a></div>
                        <div class="news-icon">@if($item->image) <img src='{{ $item->img_url.$item->image.$item->img_size['icon'] }}'> @else <img src='/img/noimg.png'> @endif</div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6" v-repeat="item in newsLoaded" v-transition="bounceIn">
                <div class="news-block" data-news-id="@{{ item.id }}">
                    <div class="news-date">@{{ item.published_at }}</div>
                    <div class="news-title"><a href="#" v-on="click: showNews($event)">@{{ item.title }}</a></div>
                    <div class="news-icon"><img v-attr="src: item.img_url + item.image + item.img_size['icon']"></div>
                </div>
            </div>
        </div>
        @if ($lastNews->hasMorePages())
            <form action="{{ $lastNews->nextPageUrl() }}" method="GET" accept-charset="UTF-8" id="form_last_news" v-on="submit: ajaxFormSubmit($event, loadNews)">
                <div class="btn-line">
                    <button type="submit" class="btn btn-danger form-button"><span class="fa fa-arrow-down btn-icon"></span> Ещё новости</button>
                </div>
            </form>
        @endif

        <div class="hidden-xs">&nbsp;</div>
        <div>&nbsp;</div>
    </div>
</section>

<footer>
    <div class="footer-inner">
        <div class="container">
            <div class="hidden-xs">&nbsp;</div>
            <div>&nbsp;</div>
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-7 text-light text-justify">
                    <p>Открытое акционерное общество Страховая компания «РОСНО‑МС» — страховая медицинская организация, специализирующаяся на обязательном и добровольном медицинском страховании.</p>
                    <p>ОАО «РОСНО‑МС» зарегистрировано 18 ноября 1994 г. Уставный капитал компании полностью оплачен и составляет 600 млн. рублей. С 2001 года ОАО «РОСНО-МС» входит в состав страховой Группы Allianz – одного из крупнейших финансово-страховых концернов, который уже более 120 лет обеспечивает надежной страховой защитой миллионы клиентов по всему миру.</p>
                    <p>Открытое акционерное общество Страховая компания «РОСНО‑МС» — страховая медицинская организация, специализирующаяся на обязательном и добровольном медицинском страховании.</p>
                    <p>© Сервис предоставляется компанией Me Car</p>
                    <div>&nbsp;</div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-5">
                    <div class="text-light text-xl text-shadow text-center">Мы в социальных сетях</div>
                    <div>&nbsp;</div>
                    <div class="row login-social">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><a href="https://www.facebook.com/groups/sellmecarbro/" target="_blank"><img src="img/social2/FB.png"></a></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><a href="http://vk.com/sellmecar" target="_blank"><img src="img/social2/VK.png"></a></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><a href="https://twitter.com/sellmecar" target="_blank"><img src="img/social2/Twitter.png"></a></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><a href="http://ok.ru/group/52443834417310" target="_blank"><img src="img/social2/Odnoklasniki.png"></a></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><img src="img/social2/ya.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-4 text-center"><img src="img/social2/G.png"></div>
                    </div>
                </div>
            </div>
            <div>&nbsp;</div>
        </div>
    </div>
</footer>

<div class="container">
    @include('partials._flash')
    @include('partials._profile')
    @include('partials._inquiry_show')
    @include('partials._inquiries_table')
    @include('partials._page_show')
    @include('partials._news_show')
    @include('partials._footer')
</div>