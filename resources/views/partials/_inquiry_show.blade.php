<div class="modal fade" id="inquiryShowModal" tabindex="-1" role="dialog" aria-labelledby="inquiryShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inquiryShowModalLabel"><i class="fa fa-list"></i> Объявление #@{{ inquiryShow.id }} на покупку автомобиля </h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    <p class="lead text-center">Куплю Автомобиль</p>
                    <p class="text-uppercase text-center">Параметры автомобиля:</p>
                    <dl class="dl-horizontal">
                        <dt>Марка</dt>
                        <dd>@{{ inquiryShow.car.name }}</dd>

                        <dt>Модель</dt>
                        <dd>@{{ inquiryShow.model }}<span v-if="! inquiryShow.model">-</span></dd>

                        <dt>Года</dt>
                        <dd>
                            <span v-if="inquiryShow.year_from > 0">с @{{ inquiryShow.year_from }}г.</span>
                            <span v-if="inquiryShow.year_to > 0">по @{{ inquiryShow.year_to }}г.</span>
                            <span v-if="inquiryShow.year_from == 0 && inquiryShow.year_to == 0">-</span>
                        </dd>

                        <dt>Цена</dt>
                        <dd>
                            <span v-if="inquiryShow.price_from > 0">от @{{ inquiryShow.price_from_formatted }} ₽</span>
                            <span v-if="inquiryShow.price_to > 0">до @{{ inquiryShow.price_to_formatted }} ₽</span>
                            <span v-if="inquiryShow.price_from == 0 && inquiryShow.price_to == 0">-</span>
                        </dd>

                        <dt v-if="inquiryShow.information">Пожелания</dt>
                        <dd v-if="inquiryShow.information"><span>@{{ inquiryShow.information }}</span></dd>

                        <div v-if="inquiryShow.carinfo">
                            <div>&nbsp;</div>
                            <p class="text-uppercase text-center">Дополнительные параметры:</p>

                            <dt v-if="inquiryShow.carinfo.gear > 0">Привод</dt>
                            <dd v-if="inquiryShow.carinfo.gear > 0"><span>@{{ vars.car_info.gear[inquiryShow.carinfo.gear] }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.transmission > 0">Трансмиссия</dt>
                            <dd v-if="inquiryShow.carinfo.transmission > 0"><span>@{{ vars.car_info.transmission[inquiryShow.carinfo.transmission] }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.engine > 0">Тип двигателя</dt>
                            <dd v-if="inquiryShow.carinfo.engine > 0"><span>@{{ vars.car_info.engine[inquiryShow.carinfo.engine] }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.rudder > 0">Руль</dt>
                            <dd v-if="inquiryShow.carinfo.rudder > 0"><span>@{{ vars.car_info.rudder[inquiryShow.carinfo.rudder] }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.color > 0">Цвет</dt>
                            <dd v-if="inquiryShow.carinfo.color > 0"><span>@{{ vars.car_info.color[inquiryShow.carinfo.color].name }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.run > 0">Пробег</dt>
                            <dd v-if="inquiryShow.carinfo.run > 0"><span>до @{{ inquiryShow.carinfo.run }} км.</span></dd>

                            <dt v-if="inquiryShow.carinfo.capacity_from > 0 || inquiryShow.carinfo.capacity_to > 0">Объем двигателя</dt>
                            <dd v-if="inquiryShow.carinfo.capacity_from > 0 || inquiryShow.carinfo.capacity_to > 0">
                                <span v-if="inquiryShow.carinfo.capacity_from > 0">от @{{ vars.car_info.capacity[inquiryShow.carinfo.capacity_from] }} л.</span>
                                <span v-if="inquiryShow.carinfo.capacity_to > 0">до @{{ vars.car_info.capacity[inquiryShow.carinfo.capacity_to] }} л.</span>
                            </dd>

                            <dt v-if="inquiryShow.carinfo.state > 0">Состояние авто</dt>
                            <dd v-if="inquiryShow.carinfo.state > 0"><span>@{{ vars.car_info.state[inquiryShow.carinfo.state] }}</span></dd>

                            <dt v-if="inquiryShow.carinfo.owners > 0">Кол-во хозяев по ПТС</dt>
                            <dd v-if="inquiryShow.carinfo.owners > 0"><span>@{{ vars.car_info.owners[inquiryShow.carinfo.owners] }}</span></dd>
                        </div>
                    </dl>
                    <hr>
                    <p class="text-uppercase text-center">Пользователь:</p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <img v-attr="src: inquiryShow.user.avatar ? inquiryShow.user.avatar : '/img/avatar.png'" class="data-avatar">
                            <span>@{{ inquiryShow.user.name }}</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div v-if="inquiryShow.user.email"><i class="fa fa-envelope"></i> : @{{ inquiryShow.user.email }}</div>
                            <div v-if="inquiryShow.phone || inquiryShow.user.phone"><i class="fa fa-phone"></i> : @{{ inquiryShow.phone ? inquiryShow.phone : inquiryShow.user.phone }}</div>
                            <div>
                                <i class="fa fa-globe"></i> : @{{ inquiryShow.city.name }}<span v-if="inquiryShow.metro">, метро @{{ inquiryShow.metro }}</span><span v-if="inquiryShow.street">, ул. @{{ inquiryShow.street }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div><i class="fa fa-calendar"></i> Дата объявления: @{{ inquiryShow.created_at }}</div>
                </div>

                <div>&nbsp;</div>
                <div>&nbsp;</div>

                <div id="disqus_thread"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>