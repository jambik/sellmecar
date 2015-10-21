function initializeSelect2()
{
    $(".select2-color").select2({
        templateResult: function(state){
            if (!state.id) { return state.text; }

            if ($(state.element).data('hex'))
            {
                var border = state.text == "Белый" ? "border: 1px solid #999;" : '';
                var state = $('<span><span style="' + border + 'display: inline-block; vertical-align: text-bottom; background: ' + $(state.element).data('hex') + '; height: 20px; width: 20px; border-radius: 10px;"></span> ' + state.text + '</span>');
                return state;
            }
        }
    });

    $(".select2-car").select2({
        placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : '',
        allowClear: true
    });
}

var DisqusReset = function (newIdentifier, newUrl, newTitle)
{
    DISQUS.reset({
        reload: true,
        config: function () {
            this.page.identifier = newIdentifier;
            this.page.url = newUrl;
            this.page.title = newTitle;
        }
    });
};

$(document).ready(function() {

    var vm = new Vue({

        el: "#body",

        data:
        {
            user: false,
            inquiryCreated: false,
            inquiryShow: false,
            inquiries: [],
            inquiriesLoaded: [],
            inquiriesSearch: false,
            inquiriesSearchFilter: '',
            showInquiryInfoFields: false,
            showAdditionalFields: false,
            newsShow: false,
            newsLoaded: [],
            pageShow: false,
            city: '',
            car: '',
            street: '',
            metro: '',
            metroOptions: [],
            model: '',
            modelOptions: [],
            models: [],
            modelsOptions: [ { text: '- Любая модель- ', value: 0 } ],
            autocomplete: false,
            API_KEY: "AIzaSyBPWHLr4_9wTreEUPAtgWiEsZ5KFXBEfUc",
            vars: false
        },

        methods:
        {
            ajaxFormSubmit: function (e, successFunction)
            {
                e.preventDefault();

                var form = e.target;

                // Место для отображения ошибок в форме
                var formStatus = $(form).find('.form-status');
                if (formStatus.length) formStatus.html('');

                // Анимированная кнопка при отправки формы
                var formButton = $(form).find('.form-button');
                if (formButton.length)
                {
                    formButton.append(' <i class="fa fa-spinner fa-spin"></i>');
                    formButton.prop('disabled', true);
                }

                $.ajax({
                    method: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: $(form).serialize(),
                    success: function (data)
                    {
                        successFunction(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        if (formStatus.length && jqXHR.status == 422) // Если статус 422 (неправильные входные данные) то отображаем ошибки
                        {
                            var formStatusText = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><div class='text-uppercase'>" + (formStatus.data('errorText') ? formStatus.data('errorText') : 'Ошибка!') + "</div><ul>";

                            $.each(jqXHR.responseJSON, function (index, value) {
                                formStatusText += "<li>" + value + "</li>";
                            });

                            formStatusText += "</ul></div>";
                            formStatus.html(formStatusText);
                            $('body').scrollTo(formStatus, 500);
                        }
                        else
                        {
                            sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                        }

                        return false;
                    },
                    complete: function (jqXHR, textStatus)
                    {
                        if (formButton.length)
                        {
                            formButton.find('i').remove();
                            formButton.prop('disabled', false);
                        }
                    }
                });
            },

            changeCars: function(e)
            {
                e.preventDefault();
                var element = e.target;

                var values = $(element).val();
                console.log(values);
            },

            selectCar: function(id)
            {
                var element = $("#brand_icon_"+id);

                var checked  = $(element).hasClass('active');
                var carName  = $(element).data('carName');

                if (checked)
                {
                    $("#car_id option[value='"+id+"']").prop('selected', false);
                    $("#car_id").trigger('change');

                    $(element).closest('.brand-item').removeClass('active');

                    $.each(this.modelsOptions, function(index, value) {
                        if (value.label == carName) {
                            this.modelsOptions.splice(index, 1);
                            return false;
                        }
                    }.bind(this));
                }
                else
                {
                    $("#car_id option[value='"+id+"']").prop('selected', true);
                    $("#car_id").trigger('change');

                    $(element).closest('.brand-item').addClass('active');

                    $.get("/carmodels/" + id, function (data) {
                        var carOptions = [];

                        $.each(data, function (index, value) {
                            carOptions.push(value.name);
                        }.bind(this));

                        if (carOptions.length) this.modelsOptions.push({label: carName, options: carOptions});
                    }.bind(this))
                    .fail(function () {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error')
                    });
                }
            },

            inquirySearchSuccess: function (data)
            {
                console.log(data);
                this.inquiriesSearch = data;

                setTimeout("$('#table_inquiries_search').trigger('updateAll')", 1);

                var searchParams = "";

                /* Поля поиска */

                // Марка автомобиля
                var searchCarId = [];
                $("input[name=car_id\\[\\]]").each(function(index, value){
                    if ($(value).is(":checked")) searchCarId.push($(value).data('carName'));
                });
                searchParams = searchParams + ( searchCarId.length ? "<li>марка: <span>" + searchCarId.join(", ") + "</span></li>\n" : "" );

                // Модель автомобиля
                searchParams = searchParams + ( $("#section_search select[name=model]").val() ? "<li>модель: <span>" + $("#section_search select[name=model]").val().join(', ') + "</span></li>\n" : "" );

                // Года
                var yearFrom = false;
                var yearTo = false;
                yearFrom = $("#section_search input[name=year_from]").val() ? "с " + $("#section_search input[name=year_from]").val()  + "г" : "";
                yearTo   = $("#section_search input[name=year_to]").val()   ? " по " + $("#section_search input[name=year_to]").val()  + "г" : "";
                searchParams = searchParams + ( yearFrom || yearTo ? "<li>года: <span>" + yearFrom + yearTo + "</span></li>\n" : "" );

                // Город
                searchParams = searchParams + ( $("#section_search select[name=city_id]").val() ? "<li>город: <span>" + $("#section_search select[name=city_id] option:selected").text() + "</span></li>\n" : "" );

                // Метро
                searchParams = searchParams + ( $("#section_search select[name=metro]").val() ? "<li>метро: <span>" + $("#section_search select[name=metro]").val() + "</span></li>\n" : "" );

                // Цена
                var priceFrom = false;
                var priceTo = false;
                numeral.language('ru');
                priceFrom = $("#section_search input[name=price_from]").val() ?  "от " + numeral($("#section_search input[name=price_from]").val()).format() + " ₽" : "";
                priceTo   = $("#section_search input[name=price_to]").val()   ? " до " + numeral($("#section_search input[name=price_to]").val()).format()   + " ₽" : "";
                searchParams = searchParams + ( priceFrom || priceTo ? "<li>цена: <span>" + priceFrom + priceTo + "</span></li>\n" : "" );

                // Привод
                searchParams = searchParams + ( $("#section_search select[name=gear]").val() ? "<li>привод: <span>" + $("#section_search select[name=gear] option:selected").text() + "</span></li>\n" : "" );

                // Трансмиссия
                searchParams = searchParams + ( $("#section_search select[name=transmission]").val() ? "<li>трансмиссия: <span>" + $("#section_search select[name=transmission] option:selected").text() + "</span></li>\n" : "" );

                // Тип двигателя
                searchParams = searchParams + ( $("#section_search select[name=engine]").val() ? "<li>тип двигателя: <span>" + $("#section_search select[name=engine] option:selected").text() + "</span></li>\n" : "" );

                // Руль
                searchParams = searchParams + ( $("#section_search select[name=rudder]").val() ? "<li>руль: <span>" + $("#section_search select[name=rudder] option:selected").text() + "</span></li>\n" : "" );

                // Цвет
                searchParams = searchParams + ( $("#section_search select[name=color]").val() ? "<li>цвет: <span>" + $("#section_search select[name=color] option:selected").text() + "</span></li>\n" : "" );

                // Пробег
                searchParams = searchParams + ( $("#section_search input[name=run]").val() ? "<li>пробег: <span>" + numeral($("#section_search input[name=run]").val()).format() + " км.</span></li>\n" : "" );

                // Объем двигателя
                var capacityFrom = false;
                var capacityTo = false;
                capacityFrom = $("#section_search select[name=capacity_from]").val() ?  "от " + $("#section_search select[name=capacity_from] option:selected").text()  : "";
                capacityTo   = $("#section_search select[name=capacity_to]").val()   ? " до " + $("#section_search select[name=capacity_to] option:selected").text() : "";
                searchParams = searchParams + ( capacityFrom || capacityTo ? "<li>объем двигателя: <span>" + capacityFrom + capacityTo + "</span></li>\n" : "" );

                // Состояние авто
                searchParams = searchParams + ( $("#section_search select[name=state]").val() ? "<li>состояние авто: <span>" + $("#section_search select[name=state] option:selected").text() + "</span></li>\n" : "" );

                // Количество хозяев по ПТС
                searchParams = searchParams + ( $("#section_search select[name=owners]").val() ? "<li>количество хозяев по ПТС: <span>" + $("#section_search select[name=owners] option:selected").text() + "</span></li>\n" : "" );


                searchParams = searchParams ? "<ul class='search-filters'>\n" + searchParams + "</ul>" : "";
                this.inquiriesSearchFilter = searchParams;
                console.log(searchParams);

                $('body').scrollTo('#section_search_results', 500);
            },

            showInquirySearchInfo: function(e)
            {
                e.preventDefault();
                this.showInquiryInfoFields = ! this.showInquiryInfoFields;
                $('#search_info').val( $('#search_info').val() == "0" ? 1 : 0 );
                setTimeout("initializeSelect2()", 1);
            },

            showAdditional: function(e)
            {
                e.preventDefault();
                this.showAdditionalFields = ! this.showAdditionalFields;
                setTimeout("initializeSelect2()", 1);
            },

            toggleBrands: function(e)
            {
                e.preventDefault();
                var element = e.target;

                if ($('.brands-hidden').is(':hidden')) {
                    $('.brands-hidden').show();
                    $('.brands-hidden').addClass('animated bounceIn');
                    $(element).html('Свернуть список');
                }
                else {
                    $('.brands-hidden').hide();
                    $('.brands-hidden').removeClass('animated bounceIn');
                    $(element).html('Показать все Марки');
                }
            },

            showCard: function(id)
            {
                $.get('/page/show/' + id, function(data) {
                    this.pageShow = data;
                    $("#pageShowModal").modal('show');
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            moveNews: function(e)
            {
                e.preventDefault();
                var element = e.target;

                $("#newsShowModal").modal('hide');
                $('#newsShowModal').on('hidden.bs.modal', function () {
                    this.showNews(false, $(element).parent().data('newsId'));
                    $('#newsShowModal').off('hidden.bs.modal');
                }.bind(this));
            },

            showNews: function(e, newsId) // Отображение объявления
            {
                if (e) {
                    e.preventDefault();
                    var element = e.target;
                    var id = $(element).closest('div.news-item').data('newsId');
                }
                else if (newsId) {
                    var element = $('div.news-item[data-news-id="' + newsId + '"]').length ? $('div.news-item[data-news-id="' + newsId + '"]') : false;
                    var id = newsId;
                }

                this.newsShow = false;
                $('#disqus_thread').hide();
                $('#newsShowModal').on('hidden.bs.modal', null);

                $("#newsShowModal").modal('show');

                var hasPrev = element ? $(element).closest('div.news-item').prev().length : false;
                var hasNext = element ? $(element).closest('div.news-item').next().length : false;

                if (hasPrev) {
                    $("#newsShowModal .pager .previous").show();
                    $("#newsShowModal .pager .previous").data('newsId', $('div.news-item[data-news-id="' + id + '"]').prev().data('newsId'));
                }
                else {
                    $("#newsShowModal .pager .previous").hide();
                }

                if (hasNext)
                {
                    $("#newsShowModal .pager .next").show();
                    $("#newsShowModal .pager .next").data('newsId', $('div.news-item[data-news-id="' + id + '"]').next().data('newsId'));
                }
                else {
                    $("#newsShowModal .pager .next").hide();
                }

                $.get('/news/show/' + id, function(data) {
                    console.log(data);
                    this.newsShow = data;

                    $('#disqus_thread').appendTo('#newsShowModal .modal-body');
                    var url = $.url();
                    DisqusReset('news-'+this.newsShow.id, url.attr('base') + url.attr('path') + "#!news="+this.newsShow.id, 'Новость №: '+this.newsShow.id);
                    $('#disqus_thread').show();
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            showInquiry: function(e, inquiryId) // Отображение объявления
            {
                if (e) {
                    e.preventDefault();
                    var element = e.target;
                    var id = $(element).closest('.inquiry-item').data('inquiryId');
                }
                else if (inquiryId) {
                    var id = inquiryId;
                }

                $.get('/inquiry/show/' + id, function(data) {
                    console.log(data);
                    this.inquiryShow = data.inquiry;
                    $("#inquiryShowModal").modal('show');
                    $('#disqus_thread').appendTo('#inquiryShowModal .modal-body');
                    var url = $.url();
                    DisqusReset('inquiry-'+this.inquiryShow.id, url.attr('base') + url.attr('path') + "#!inquiry="+this.inquiryShow.id, 'Объявление №: '+this.inquiryShow.id);
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            loadInquiries: function (data) // Функция загрузки последних объявлений
            {
                this.inquiriesLoaded = this.inquiriesLoaded.concat(data.data);

                if (data.next_page_url)
                {
                    $('#form_last_inquiries').attr('action', data.next_page_url);
                }
                else
                {
                    $('#form_last_inquiries').remove();
                }
            },

            loadNews: function (data) // Функция загрузки последних новостей
            {
                this.newsLoaded = this.newsLoaded.concat(data.data);

                if (data.next_page_url)
                {
                    $('#form_last_news').attr('action', data.next_page_url);
                }
                else
                {
                    $('#form_last_news').remove();
                }
            },

            registrationSuccess: function (data) // Функция обработчик успешной регистрации
            {
                $("#container_step1").effect('slide', { direction: 'left', mode: 'hide' }, 300, function(){
                    $("#container_step2").effect('slide', { direction: 'right', mode: 'show' }, 500);
                    this.profileLoad();
                    this.changeCar();
                    this.changeCity();
                }.bind(this));

                $("#login_menu").hide();
                $("#user_menu").show();
                $("#user_menu").data('userLogged', 'true');
            },

            profileLoad: function () // Функция загрузки профиля в форму
            {
                $.get('/profile', function(data) {
                    console.log(data);
                    this.user = data.user;
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            profileSaveSuccess: function (data) // Функция обработчик успешного обновления профиля
            {
                console.log(data);

                if(data.status == "success")
                {
                    var formStatusText = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    formStatusText += data.message;
                    formStatusText += "</div>";
                    $('#form_profile').find('.form-status').html(formStatusText);
                }
            },

            inquiryCreateSuccess: function (data) // Обработчик добавления объявления
            {
                console.log(data);

                this.inquiryCreated = data.inquiry;

                $("#container_step2").effect('slide', { direction: 'left', mode: 'hide' }, 300, function(){
                    $("#container_step3").effect('slide', { direction: 'right', mode: 'show' }, 500);
                    $('body').scrollTo('#section_apply', 500); return false;
                });
            },

            inquiriesLoad: function () // Функция загрузки объявлений
            {
                $.get('/inquiry/private', function(data) {
                    console.log(data);
                    this.inquiries = data.inquiries ? data.inquiries : false;
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            // Функция обработчик формы удаления объявления
            inquiryDelete: function (inquiry)
            {
                if(confirm('Вы действительно хотите удалить объявление #' + inquiry.id))
                {
                    $.get('/inquiry/delete/' + inquiry.id, function (data) {
                        this.inquiries.splice(this.inquiries.map(function(item) { return item.id; }).indexOf(inquiry.id), 1);
                        console.log(data);
                    }.bind(this))
                    .fail(function () {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    });
                }
            },

            changeCar: function() // Изменение Марки авто
            {
                this.model = "";
                this.modelOptions = [];
                $("select[name='model']").val('');
                setTimeout("$(\"select[name='model']\").select2({language: 'ru', tags: true, allowClear: true, placeholder: '- Модель авто -'})", 1);

                if (this.car)
                {
                    $.get("/carmodels/" + this.car, function (data) {
                        $.each(data, function (index, value) {
                            this.modelOptions.push(value.name);
                        }.bind(this));
                    }.bind(this))
                    .fail(function () {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    });
                }

            },

            changeCity: function() // Изменение города
            {
                this.metro = "";
                this.metroOptions = [];
                $("select[name='metro']").val('');

                if (this.city)
                {
                    $.get("/metro/" + this.city, function (data) {
                        $.each(data, function (index, value) {
                            this.metroOptions.push(value.name);
                            //this.metroOptions.push({text: value.name, value: value.id });
                        }.bind(this));
                        setTimeout("$(\"select[name='metro']\").select2({language: 'ru', allowClear: true, placeholder: '- Ближайшее метро -'})", 1);
                    }.bind(this))
                    .fail(function () {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    });
                }

                this.initAutocomplete();
            },

            initAutocomplete: function () // Инициализация Google Autocomplete
            {
                $('#form_inquiry').on('keyup keypress', function(e)
                {
                    var code = e.keyCode || e.which;
                    if (code == 13) {
                        e.preventDefault();
                        return false;
                    }
                });

                $.get("https://maps.googleapis.com/maps/api/geocode/json?address=г. " + $( "#city option:selected" ).text() + "&key=" + this.API_KEY + "&language=ru", function(data) {
                    var northEast = new google.maps.LatLng( data.results[0].geometry.bounds.northeast.lat, data.results[0].geometry.bounds.northeast.lng );
                    var southWest = new google.maps.LatLng( data.results[0].geometry.bounds.southwest.lat, data.results[0].geometry.bounds.southwest.lng );

                    this.autocomplete = new google.maps.places.Autocomplete( (document.getElementById('street')), { bounds: new google.maps.LatLngBounds( southWest, northEast ), types: ['address'], componentRestrictions: {'country': 'ru'} });
                    this.autocomplete.addListener('place_changed', this.fillInAddress);
                }.bind(this))
                .fail(function() {
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                });
            },

            fillInAddress: function() // Выбор адреса из Google Autocomplete
            {
                var place = this.autocomplete.getPlace();

                for (var i = 0; i < place.address_components.length; i++)
                {
                    var addressType = place.address_components[i].types[0];
                    if (addressType == 'route') this.street = place.address_components[i].long_name;
                }
            },

            varsLoad: function()
            {
                if ( ! this.vars)
                {
                    $.get("/vars", function (data) {
                        this.vars = data;
                    }.bind(this))
                    .fail(function () {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    });
                }
            },

            checkUrlFragment: function()
            {
                var url = $.url();

                if (url.data.attr.fragment)
                {
                    if (url.data.attr.fragment.indexOf("!news=") >= 0)
                    {
                        var id = url.data.attr.fragment.substr( url.data.attr.fragment.indexOf("=") + 1 );
                        this.showNews(false, id);
                    }
                    else if (url.data.attr.fragment.indexOf("!inquiry=") >= 0)
                    {
                        var id = url.data.attr.fragment.substr( url.data.attr.fragment.indexOf("=") + 1 );
                        this.showInquiry(false, id);
                    }
                }
            },
        },

        ready: function()
        {
            this.varsLoad();
            this.changeCar();

            this.checkUrlFragment();

            $.tablesorter.themes.bootstrap = {
                table        : 'table table-striped',
                caption      : 'caption',
                header       : 'bootstrap-header',
                iconSortNone : 'bootstrap-icon-unsorted',
                iconSortAsc  : 'glyphicon glyphicon-chevron-up',
                iconSortDesc : 'glyphicon glyphicon-chevron-down',
            };

            $('#table_inquiries_search').tablesorter({
                theme : "bootstrap",
                widthFixed: true,
                headerTemplate : '{content} {icon}',
                widgets : [ "uitheme" ]
            });

            // Обработчик кнопки Дать объявление (шаг 0)
            if ($('#btn_inquiry_create').length)
            {
                $("#btn_inquiry_create").on( "click", function() {
                    $("#container_step0").effect('slide', { direction: 'left', mode: 'hide' }, 300, function(){
                        if($('#user_menu').data('userLogged'))
                        {
                            this.profileLoad();
                            this.changeCar();
                            this.changeCity();
                            $("#container_step2").effect('slide', {direction: 'right', mode: 'show'}, 500);
                        }
                        else
                        {
                            $("#container_step1").effect('slide', {direction: 'right', mode: 'show'}, 500);
                        }
                    }.bind(this));
                }.bind(this));
            }

            // Обработчик кнопки назад (шаг 1)
            if ($('#btn_back_start').length)
            {
                $("#btn_back_start").on( "click", function() {
                    $("#container_step1").effect('slide', { direction: 'right', mode: 'hide' }, 300, function(){
                        $("#container_step0").effect('slide', { direction: 'left', mode: 'show' }, 500);
                    });
                });
            }

            // Инициализируем плагин select2
            if ($('.select2').length) $('.select2').each(function(index){
                $(this).select2( {language: "ru", placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : ''} );
            });

            // Инициализируем компонент select2
            initializeSelect2();

            var eventSelect = $("#car_id");

            eventSelect.on("select2:select", function (e) {
                this.selectCar(e.params.data.id);
            }.bind(this));
            eventSelect.on("select2:unselect", function (e) {
                this.selectCar(e.params.data.id);
            }.bind(this));

            // Инициализируем выбор годов автомобиля
            $("input[name='year_from']").datetimepicker({ locale: "ru", viewMode: 'years', format: 'YYYY', minDate: moment().subtract(50, 'years'), maxDate: moment() });
            $("input[name='year_to']").datetimepicker({ locale: "ru", viewMode: 'years', format: 'YYYY', minDate: moment().subtract(50, 'years'), maxDate: moment() });

            // Добавляем маску полю, типа - цена
            $('input.mask-price').inputmask({
                alias: 'numeric',
                groupSeparator: ' ',
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                suffix: ' ₽',
                rightAlign: false,
                autoUnmask: true
            });

            // Добавляем маску полю, типа - км
            $('input.mask-km').inputmask({
                alias: 'numeric',
                groupSeparator: ' ',
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                suffix: ' км.',
                rightAlign: false,
                autoUnmask: true
            });

            $.scrollUp({
                scrollName: 'scrollUp',      // Element ID
                scrollDistance: 300,         // Distance from top/bottom before showing element (px)
                scrollFrom: 'top',           // 'top' or 'bottom'
                scrollSpeed: 300,            // Speed back to top (ms)
                easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
                animation: 'fade',           // Fade, slide, none
                animationSpeed: 200,         // Animation speed (ms)
                scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
                scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
                scrollText: 'Главная',       // Text for element, can contain HTML
                scrollTitle: false,          // Set a custom <a> title if required.
                scrollImg: false,            // Set true to use image
                activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                zIndex: 2147483647           // Z-Index for the overlay
            });
        }

    });

    function showInquiry(element)
    {
        var element = e.target;
        var id = $(element).closest('.inquiry-item').data('inquiryId');

        $.get('/inquiry/show/' + id, function(data) {
            console.log(data);
            vm.inquiryShow = data.inquiry;
            $("#inquiryShowModal").modal('show');
        }.bind(this))
        .fail(function() {
            sweetAlert("", "Ошибка при запросе к серсеру", 'error');
        });
    }

});

Vue.transition('bounceIn', {
    enter: function (el) { $(el).addClass('animated bounceIn'); },
    leave: function (el) { $(el).removeClass('animated bounceIn'); }
});

Vue.transition('flipInX', {
    enter: function (el) { $(el).addClass('animated flipInX'); },
    leave: function (el) { $(el).removeClass('animated flipInX'); }
});