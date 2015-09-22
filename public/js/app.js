$(document).ready(function() {

    var vm = new Vue({

        el: "#body",

        data:
        {
            user: false,
            inquiryCreated: false,
            inquiries: [],
            inquiriesLoaded: [],
            newsLoaded: [],
            city: '',
            street: "",
            metro: "",
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
                this.metroOptions = [];

                $.get("/metro/" + (this.city ? this.city : 'Москва'), function(data) {
                    $.each(data, function(index, value) {
                        this.metroOptions.push(value.name);
                    }.bind(this));
                }.bind(this))
                .fail(function() {
                    alert("Ошибка при запросе");
                });

                $("#metro").val('');
                $("#metro").select2({language: 'ru'});
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
                        if($('#user_menu').is(':visible')) {
                            this.profileLoad();
                            $("#container_step2").effect('slide', {direction: 'right', mode: 'show'}, 500);
                        }
                        else {
                            this.profileLoad();
                            $("#container_step1").effect('slide', {direction: 'right', mode: 'show'}, 500);

                        }

                        $("#metro").val('');
                        $("#metro").select2();
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
            if ($('.yearpicker').length) $('.yearpicker').datepicker({ format: "yyyy", minViewMode: 2 });
        }

    });

});

Vue.transition('bounceIn', {
    enter: function (el) {
        $(el).addClass('animated bounceIn');
    },
    enterCancelled: function (el) {
        // handle cancellation
    },

    leave: function (el) {
        $(el).removeClass('animated bounceIn');
    },
    leaveCancelled: function (el) {
        // handle cancellation
    }
})