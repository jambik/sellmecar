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
            showInquiryInfoFields: false,
            newsShow: false,
            newsLoaded: [],
            pageShow: false,
            city: '',
            street: '',
            metro: '',
            metroOptions: [],
            autocomplete: false,
            API_KEY: "AIzaSyBrxH2cAEZwZGhQlJbnxTE6lqN6PXiYdNo"
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
                            var formStatusText = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><div class='text-uppercase'>Ошибка!</div><ul>";

                            $.each(jqXHR.responseJSON, function (index, value) {
                                formStatusText += "<li>" + value + "</li>";
                            });

                            formStatusText += "</ul></div>";
                            formStatus.html(formStatusText);
                        }
                        else
                        {
                            alert('Возникла ошибка во время запроса.')
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

            inquirySearchSuccess: function (data)
            {
                //console.log(data);
                this.inquiriesSearch = { found: data.found, suggest: data.suggest };
                console.log(this.inquiriesSearch);
                $('body').scrollTo('#section_search_results', 500);
            },

            showInquirySearchInfo: function(e)
            {
                e.preventDefault();
                this.showInquiryInfoFields = ! this.showInquiryInfoFields;
            },

            showCard: function(id)
            {
                $.get('/page/show/' + id, function(data) {
                    this.pageShow = data;
                    $("#pageShowModal").modal('show');
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
                });
            },

            showNews: function(e) // Отображение объявления
            {
                e.preventDefault();
                var element = e.target;
                var id = $(element).closest('div.news-block').data('newsId');

                $.get('/news/show/' + id, function(data) {
                    console.log(data);
                    this.newsShow = data;
                    $("#newsShowModal").modal('show');
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
                });
            },

            showInquiry: function(e) // Отображение объявления
            {
                e.preventDefault();
                var element = e.target;
                var id = $(element).closest('.inquiry-item').data('inquiryId');

                $.get('/inquiry/show/' + id, function(data) {
                    console.log(data);
                    this.inquiryShow = data.inquiry;
                    $("#inquiryShowModal").modal('show');
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
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
                    this.changeCity();
                }.bind(this));

                $("#user_name").html( $("#form_register input[name='name']").val() );
                $("#login_menu").hide();
                $("#user_menu").show();
            },

            profileLoad: function () // Функция загрузки профиля в форму
            {
                $.get('/profile', function(data) {
                    console.log(data);
                    this.user = data.user;
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
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
                });
            },

            inquiriesLoad: function () // Функция загрузки объявлений
            {
                $.get('/inquiry/private', function(data) {
                    console.log(data);
                    this.inquiries = data.inquiries ? data.inquiries : false;
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
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
                        alert("Ошибка при запросе");
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
                        alert("Ошибка при запросе");
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
                    alert("Ошибка при запросе");
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
            }
        },

        ready: function()
        {
            this.changeCity();

            // Обработчик кнопки Дать объявление (шаг 0)
            if ($('#btn_inquiry_create').length)
            {
                $("#btn_inquiry_create").on( "click", function() {
                    $("#container_step0").effect('slide', { direction: 'left', mode: 'hide' }, 300, function(){
                        if($('#user_menu').is(':visible'))
                        {
                            this.profileLoad();
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
            if ($('.select2').length) $('.select2').select2({language: "ru"});

            // Инициализируем выбор годов автомобиля
            if ($('.input-year').length) $('.input-year').datetimepicker({ locale: "ru", viewMode: 'years', format: 'YYYY' });

            // Добавляем маску полям
            $('input.mask-price').inputmask({
                alias: 'numeric',
                groupSeparator: ' ',
                autoGroup: true,
                digits: 0,
                digitsOptional: false,
                suffix: ' руб.',
                rightAlign: false,
                autoUnmask: true
            });
        }

    });

});

Vue.transition('bounceIn', {
    enter: function (el) { $(el).addClass('animated bounceIn'); },
    leave: function (el) { $(el).removeClass('animated bounceIn'); }
});

Vue.transition('flipInX', {
    enter: function (el) { $(el).addClass('animated flipInX'); },
    leave: function (el) { $(el).removeClass('animated flipInX'); }
});