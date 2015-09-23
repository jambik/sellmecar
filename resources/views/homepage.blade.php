@include('partials._header', ['title' => 'Sellmecar - главная'])

<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 logo">
                <a href="/"><img src="img/logo.png" class="img-responsive" alt=""></a>
            </div>
            <div class="col-lg-7 col-md-8 col-sm-8 menu text-center">
                <ul>
                    <li><a href="#" onclick="$('body').scrollTo('#section_inquiries', 500); return false;">Объявления</a></li>
                    <li><a href="#" onclick="$('body').scrollTo('#section_apply', 500); return false;">Покупателям</a></li>
                    <li><a href="#" onclick="$('body').scrollTo('#section_search', 500); return false;">Продавцам</a></li>
                    <li><a href="#" onclick="$('body').scrollTo('#section_news', 500); return false;">Новости</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div id="login_menu" style="display: {{ Auth::check() ? 'none' : 'block' }}">
                    {{--<a href="/auth/login">Вход</a>--}}
                    <a href="#" class="dropdown-toggle login-link" id="dropdownLogin" data-toggle="dropdown" aria-expanded="true">Вход</a>
                    <div class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownLogin">
                        <div id="login_block">
                            <form action="/auth/login" method="POST" id="form_login">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Пароль" class="form-control" />
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
                                <a href="/auth/facebook"><img src="img/social/FB.png"></a>
                                <a href="/auth/vkontakte"><img src="img/social/VK.png"></a>
                                <a href="/auth/twitter"><img src="img/social/Twitter.png"></a>
                                <a href="/auth/odnoklassniki"><img src="img/social/Odnoklasniki.png"></a>
                                <a href="/auth/yandex"><img src="img/social/ya.png"></a>
                                <a href="/auth/google"><img src="img/social/G.png"></a>
                            </div>
                            <hr />
                            <a href="/auth/register" class="btn btn-block btn-success">Регистрация на сайте</a>
                        </div>
                    </div>
                </div>
                <div id="user_menu" style="display: {{ Auth::check() ? 'block' : 'none' }};">
                    <div class="dropdown user-links">
                        <div><img src="{{ Auth::check() && Auth::user()->avatar ? Auth::user()->avatar : '/img/avatar.png' }}"></div>
                        <a href="#" class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-expanded="true"><span id="user_name">{{ Auth::check() ? Auth::user()->name : '' }}</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownUser">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#profileModal" v-on="click: profileLoad"><i class="fa fa-user"></i> Данные аккаунта</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#inquiriesModal" v-on="click: inquiriesLoad"><i class="fa fa-list"></i> Мои объявления</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="/auth/logout"><i class="fa fa-sign-out"></i> Выход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="section_apply">
    <div>&nbsp;</div>
    <div>&nbsp;</div>


    {{--Шаг 0: Баннер--}}
    <div class="container" id="container_step0" style="display: {{ !Request::has('step') || Request::get('step') == 0 ? 'block' : 'none' }};">
        <div>&nbsp;</div>
        <div class="text-light text-xxl text-shadow text-center">Как дать объявление на покупку автомобиля</div>
        <div>&nbsp;</div>
        <div class="row">
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

        <div class="text-center"><span class="text-dream">Мечта сама приедет к вам!</span></div>

        <p class="text-shadow text-light text-about">Уникальность нашего сайта состоит в том, что покупатель выставляет свое объявление, а продавец автомобиля  ищет именно то, объявление, где есть сходство с его автомобилем!</p>

        <div>&nbsp;</div>
        <div class="btn-line">
            <button class="btn btn-lg btn-danger" id="btn_inquiry_create"><span class="fa fa-list-alt btn-icon"></span> Дать объявление</button>
        </div>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 0/--}}



    {{--Шаг 1: Регистрация--}}
    <div class="container" id="container_step1" style="display: {{ Request::has('step') && Request::get('step') == 1 ? 'block' : 'none' }};">
        <div>&nbsp;</div>
        <div class="text-light text-xxl text-shadow text-center">Регистрация</div>
        <div>&nbsp;</div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                <form action="/auth/register" method="POST" class="form-ajax" id="form_register" v-on="submit: ajaxFormSubmit($event, registrationSuccess)">
                    <div class="form-status"></div>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Имя" class="form-control input-lg" />
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control input-lg" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" class="form-control input-lg" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" placeholder="Пароль еще раз" class="form-control input-lg" />
                    </div>
                    <hr>
                    {!! Form::token() !!}
                    <button class="btn btn-lg btn-block btn-success form-button">Регистрация</button>
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 login-social">
                <div class="text-xl text-light text-center text-shadow">Войти через соцсети</div>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/facebook"><img src="img/social/FB.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/vkontakte"><img src="img/social/VK.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/twitter"><img src="img/social/Twitter.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/odnoklassniki"><img src="img/social/Odnoklasniki.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/yandex"><img src="img/social/ya.png"></a></div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center"><a href="/auth/google"><img src="img/social/G.png"></a></div>
                </div>
            </div>
        </div>

        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="btn-line">
            <button id="btn_back_start" class="btn btn-lg btn-danger"><span class="fa fa-arrow-circle-o-left btn-icon"></span> Назад</button>
        </div>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 1/--}}


    {{--Шаг 2: Дать объявление--}}
    <div class="container" id="container_step2" style="display: {{ Request::has('step') && Request::get('step') == 2 ? 'block' : 'none' }};">
        <div>&nbsp;</div>
        <div class="text-light text-xxl text-shadow text-center">Дать объявление</div>
        <div>&nbsp;</div>
        <form action="{{ route('inquiryStore') }}" method="POST" id="form_inquiry" class="form-ajax" v-on="submit: ajaxFormSubmit($event, inquiryCreateSuccess)">
            <div class="form-status"></div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                    <div class="form-group">
                        {!! Form::label('car_id', 'Автомобиль:') !!}
                        {!! Form::select('car_id', $carsList, null, ['class' => 'form-control input-lg select2', 'style' => 'width: 100%; height: 40px;']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('model', 'Модель автомобиля:') !!}
                        {!! Form::text('model', null, ['class' => 'form-control input-lg', 'placeholder' => 'Camry']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('transmission', 'Трансмиссия:') !!}
                        {!! Form::select('transmission', [1 => 'Автомат', 2 => 'Механика', 0 => 'Не важно'], null, ['class' => 'form-control input-lg']) !!}
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::label('price_from', 'Цена, от:') !!}
                            {!! Form::text('price_from', null, ['class' => 'form-control input-lg', 'placeholder' => 'цена от']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::label('price_to', 'до:') !!}
                            {!! Form::text('price_to', null, ['class' => 'form-control input-lg', 'placeholder' => 'цена до']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::label('year_from', 'Год выпуска, от:') !!}
                            {!! Form::text('year_from', null, ['class' => 'form-control input-lg yearpicker', 'placeholder' => 'год от']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::label('year_to', 'до:') !!}
                            {!! Form::text('year_to', null, ['class' => 'form-control input-lg yearpicker', 'placeholder' => 'год до']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="form-group">
                        <label for="city">Город:</label>
                        <select name="city" placeholder="Выберите город" class="form-control input-lg" v-model="city" v-on="change: changeCity">
                            @foreach($cities as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="metro">Метро:</label>
                                <select name="metro" data-placeholder="Ближайшее метро" id="metro" class="form-control input-lg select2" v-model="metro" options="metroOptions">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="street">Улица:</label>
                                <input type="text" name="street" id="street" class="form-control input-lg" v-model="street">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" name="name" id="name" class="form-control input-lg" v-model="user.name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Телефон:</label>
                                <input type="text" name="phone" id="phone" class="form-control input-lg" v-model="user.phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('information', 'Дополнительная информация:') !!}
                        {!! Form::textarea('information', null, ['class' => 'form-control input-lg', 'rows' => 4, 'style' => 'height: 133px;', 'placeholder' => 'Например: хочу машину белого цвета, не битую']) !!}
                    </div>
                </div>
            </div>

            <div>&nbsp;</div>
            <div class="btn-line">
                <button type="submit" class="btn btn-lg btn-danger form-button"><span class="fa fa-check-square-o btn-icon"></span> Опублковать объявление</button>
            </div>
            {!! Form::token() !!}
        </form>
        <div>&nbsp;</div>
    </div>
    {{--/Шаг 2/--}}



    {{--Шаг 3: Просмотр объявления--}}
    <div class="container" id="container_step3" style="display: {{ Request::has('step') && Request::get('step') == 3 ? 'block' : 'none' }};">
        <div>&nbsp;</div>

        <div class="text-light text-xxl text-shadow text-center">Мое объявление</div>
        <div>&nbsp;</div>
        <div class="text-light text-l text-shadow text-center">Уважаемый (ая): @{{ inquiryCreated.name }}, Ваше объявление размещено под номером <span class="inquiry-new-id">@{{ inquiryCreated.id }}</span></div>
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
                    <div class="col-lg-6">Трансмиссия:</div>
                    <div class="col-lg-6">
                        @{{ inquiryCreated.transmission_name }}
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
                        <span>@{{ inquiryCreated.city }}</span>
                        <span v-if="inquiryCreated.metro">, метро @{{ inquiryCreated.metro }}</span>
                        <span v-if="inquiryCreated.street">, ул. @{{ inquiryCreated.street }}</span>
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
    <div>&nbsp;</div>
</section>

<section id="section_search">
    <div class="container">
        <div>&nbsp;</div>
        <div class="text-dark text-xxl text-center">Как продать свой автомобиль</div>

        <p class="text-center">Сначала выберите марку Вашего автомобиля (лей)</p>

        <div class="row brands">
            @for ($i = 0; ($i < $carBrandsShow && $i < $cars->count()); $i++)
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="checkbox">
                        <label>
                            <div class="car-image">@if($cars[$i]->image) <img src='{{ $cars[$i]->img_url.$cars[$i]->image.$cars[$i]->img_size['xs'] }}'> @endif</div>
                            <input type="checkbox"> {{ $cars[$i]->name }} <span>{{ $cars[$i]->inquiriesCount ? "(".$cars[$i]->inquiriesCount.")" : '' }}</span>
                        </label>
                    </div>
                </div>
            @endfor

            @if ($carBrandsShow < $cars->count())
                <div class="more-brands text-center"><a href="#" onclick="$('.brands-hidden').show(); $('.brands-hidden').addClass('animated bounceIn'); $(this).hide(); return false;">Смотреть еще</a></div>

                <div class="brands-hidden">
                    @for ($i = $carBrandsShow; ($i < $cars->count()); $i++)
                        <div class="col-lg-2 col-md-3 col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <div class="car-image">@if($cars[$i]->image) <img src='{{ $cars[$i]->img_url.$cars[$i]->image.$cars[$i]->img_size['xs'] }}'> @endif</div>
                                    <input type="checkbox"> {{ $cars[$i]->name }} <span>{{ $cars[$i]->inquiriesCount ? "(".$cars[$i]->inquiriesCount.")" : '' }}</span>
                                </label>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        </div>

        <div>&nbsp;</div>
        <div class="hr"></div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>

        <p class="text-xl text-center">Поиск объявлений по параметрам Вашего авто</p>
        <div>&nbsp;</div>

        <form class="form">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <input type="text" name="model" placeholder="Модель авто" class="form-control input-lg">
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::text('price_from', null, ['class' => 'form-control input-lg', 'placeholder' => 'Цена - от']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::text('price_to', null, ['class' => 'form-control input-lg', 'placeholder' => 'Цена - до']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <select name="city" placeholder="Выберите город" class="form-control input-lg" v-model="city" v-on="change: changeCity">
                            <option value="">- Выберите город -</option>
                            @foreach($cities as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="metro" data-placeholder="Ближайшее метро" id="metro" class="form-control input-lg select2" v-model="metro" options="metroOptions">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>

            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div class="more-search text-center"><a href="#" v-on="click: searchInfo($event)"><i class="fa fa-search"></i> Расширенный поиск</a></div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>

            <div class="row" id="search_car_info" style="display: none;">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::text('year_from', null, ['class' => 'form-control input-lg yearpicker', 'placeholder' => 'Год выпуска - от']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::text('year_to', null, ['class' => 'form-control input-lg yearpicker', 'placeholder' => 'Год выпуска - до']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <select name="transmission" placeholder="- Привод -" class="form-control input-lg">
                                <option value="0">- Привод -</option>
                                <option value="0">Неважно</option>
                                <option value="1">Задний</option>
                                <option value="2">Передний</option>
                                <option value="3">Полный</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <select name="transmission" placeholder="- Трансмиссия -" class="form-control input-lg">
                                <option value="0">- Трансмиссия -</option>
                                <option value="0">Неважно</option>
                                <option value="1">Автомат</option>
                                <option value="2">Механика</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <select name="transmission" placeholder="- Тип двигателя -" class="form-control input-lg">
                                <option value="0">- Тип двигателя -</option>
                                <option value="0">Неважно</option>
                                <option value="1">Бензин</option>
                                <option value="2">Дизенль</option>
                                <option value="3">Гибрид</option>
                                <option value="4">Бензин / Газ</option>
                                <option value="5">Электро</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <select name="transmission" placeholder="- Руль -" class="form-control input-lg">
                                <option value="0">- Руль -</option>
                                <option value="0">Неважно</option>
                                <option value="1">Левый</option>
                                <option value="2">Правый</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <select name="transmission" placeholder="- Цвет -" class="form-control input-lg">
                                <option value="0">- Цвет -</option>
                                <option value="0">Неважно</option>
                                @foreach (config('vars.car_info.color') as $item)
                                    <option value="{{ $item['name'] }}" data-hex="{{ $item['hex'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" name="model" placeholder="Пробег до, км" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            {!! Form::text('year_from', null, ['class' => 'form-control input-lg', 'placeholder' => 'Объем двигателя от, л.']) !!}
                        </div>
                        <div class="form-group col-lg-6">
                            {!! Form::text('year_to', null, ['class' => 'form-control input-lg', 'placeholder' => 'Объем двигателя до, л.']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="btn-line">
            <button class="btn btn-lg btn-danger"><span class="fa fa-search btn-icon"></span> Искать по параметрам</button>
        </div>
        <div>&nbsp;</div>
    </div>
</section>

<section id="section_inquiries">
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="container">
        <div>&nbsp;</div>
        <div class="text-light text-xxl text-shadow text-center">Последние объявления</div>
        <div>&nbsp;</div>

        <div class="row">
            @foreach ($lastInquiries as $item)
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="inquiry-block" data-inquiry-id="{{ $item->id }}">
                        @if($item->car->image)<div class="car-image"><img src='{{ $item->car->img_url.$item->car->image.$item->car->img_size['xs'] }}'></div>@endif
                        <div class="text-uppercase text-l">Куплю:</div>
                        <div class="block-line">автомобиль: <div class="value">{{ $item->car->name }}{{ $item->model ? ', '.$item->model : '' }}</div></div>
                        <div class="block-line">года: <div class="value">{{ $item->year_from ? 'с '.$item->year_from.'г. ' : '' }}{{ $item->year_to ? 'по '.$item->year_to.'г. ' : '' }}{{ $item->year_from && $item->year_to ? '' : '-' }}</div></div>
                        <div class="block-line">трансмиссия: <div class="value">{{ $item->transmission_name }}</div></div>
                        <div class="block-line">город: <div class="value">{{ $item->city }}</div></div>
                        <a href="#" class="btn btn-block btn-success" v-on="click: showInquiry($event)">Подробнее</a>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-3 col-sm-4" v-repeat="item in inquiriesLoaded" v-transition="bounceIn">
                <div class="inquiry-block" data-inquiry-id="@{{ item.id }}">
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
                            <span v-if="item.year_from">с @{{ item.year_from }}г.</span>
                            <span v-if="item.year_to">по @{{ item.year_to }}г.</span>
                            <span v-if="! item.year_from && ! item.year_to">-</span>
                        </div>
                    </div>
                    <div class="block-line">трансмиссия: <div class="value">@{{ item.transmission_name }}</div></div>
                    <div class="block-line">город: <div class="value">@{{ item.city }}</div></div>
                    <a href="#" class="btn btn-block btn-success" v-on="click: showInquiry($event)">Подробнее</a>
                </div>
            </div>
        </div>
        @if ($lastInquiries->hasMorePages())
            <form action="{{ $lastInquiries->nextPageUrl() }}" method="GET" id="form_last_inquiries" v-on="submit: ajaxFormSubmit($event, loadInquiries)">
                <div class="btn-line">
                    <button type="submit" class="btn btn-lg btn-danger form-button"><span class="fa fa-arrow-down btn-icon"></span> Ещё объявления</button>
                </div>
            </form>
        @endif
        <div>&nbsp;</div>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
</section>

<section id="section_news">
    <div class="container">
        <div>&nbsp;</div>
        <div class="text-dark text-xxl text-center">Новости</div>
        <div>&nbsp;</div>

        <div class="row">
            @foreach ($lastNews as $item)
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="news-block" data-news-id="{{ $item->id }}">
                        <div class="news-date">{{ $item->published_at->diffForHumans() }}</div>
                        <div class="news-title"><a href="#" v-on="click: showNews($event)">{{ $item->title }}</a></div>
                        <div class="news-icon">@if($item->image) <img src='{{ $item->img_url.$item->image.$item->img_size['icon'] }}'> @else <img src='/img/noimg.png'> @endif</div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-3 col-md-3 col-sm-4" v-repeat="item in newsLoaded" v-transition="bounceIn">
                <div class="news-block" data-news-id="@{{ item.id }}">
                    <div class="news-date">@{{ item.published_at }}</div>
                    <div class="news-title"><a href="#" v-on="click: showNews($event)">@{{ item.title }}</a></div>
                    <div class="news-icon"><img v-attr="src: item.img_url + item.image + item.img_size['icon']"></div>
                </div>
            </div>
        </div>
        @if ($lastNews->hasMorePages())
            <form action="{{ $lastNews->nextPageUrl() }}" method="GET" id="form_last_news" v-on="submit: ajaxFormSubmit($event, loadNews)">
                <div class="btn-line">
                    <button type="submit" class="btn btn-lg btn-danger form-button"><span class="fa fa-arrow-down btn-icon"></span> Ещё новости</button>
                </div>
            </form>
        @endif

        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
    </div>
</section>

<footer>
    <div class="footer-inner">
        <div class="container">
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-7 text-l text-light text-justify">
                    <p>Открытое акционерное общество Страховая компания «РОСНО‑МС» — страховая медицинская организация, специализирующаяся на обязательном и добровольном медицинском страховании.</p>
                    <p>ОАО «РОСНО‑МС» зарегистрировано 18 ноября 1994 г. Уставный капитал компании полностью оплачен и составляет 600 млн. рублей. С 2001 года ОАО «РОСНО-МС» входит в состав страховой Группы Allianz – одного из крупнейших финансово-страховых концернов, который уже более 120 лет обеспечивает надежной страховой защитой миллионы клиентов по всему миру.</p>
                    <p>Открытое акционерное общество Страховая компания «РОСНО‑МС» — страховая медицинская организация, специализирующаяся на обязательном и добровольном медицинском страховании.</p>
                    <p class="copyright">© Сервис предоставляется компанией Me Car</p>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-5">
                    <div class="text-light text-xxl text-shadow text-center">Мы в социальных сетях</div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/FB.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/VK.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/Twitter.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/Odnoklasniki.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/ya.png"></div>
                        <div class="col-lg-4 col-md-4 col-sm-6 text-center"><img src="img/social/G.png"></div>
                    </div>
                </div>
            </div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
            <div>&nbsp;</div>
        </div>
    </div>
</footer>

@include('partials._flash')
@include('partials._profile')
@include('partials._inquiry_show')
@include('partials._inquiries_table')
@include('partials._page_show')
@include('partials._news_show')
@include('partials._footer')