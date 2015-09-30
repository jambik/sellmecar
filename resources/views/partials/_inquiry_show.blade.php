<div class="modal fade" id="inquiryShowModal" tabindex="-1" role="dialog" aria-labelledby="inquiryShowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inquiryShowModalLabel"><i class="fa fa-list"></i> Объявление #@{{ inquiryShow.id }}</h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    <p class="text-uppercase text-center text-l">Параметры автомобиля:</p>
                    <dl class="dl-horizontal">
                        <dt>Марка</dt>
                        <dd>@{{ inquiryShow.car.name }}</dd>

                        <dt>Модель</dt>
                        <dd>@{{ inquiryShow.model }}</dd>

                        <dt>Трансмиссия</dt>
                        <dd>@{{ inquiryShow.transmission_name }}</dd>

                        <dt>Года</dt>
                        <dd>
                            <span v-if="inquiryShow.year_from">с @{{ inquiryShow.year_from }}г.</span>
                            <span v-if="inquiryShow.year_to">по @{{ inquiryShow.year_to }}г.</span>
                            <span v-if="! inquiryShow.year_from && ! inquiryShow.year_to">-</span>
                        </dd>

                        <dt>Цена</dt>
                        <dd>
                            <span v-if="inquiryShow.price_from">от @{{ inquiryShow.price_from_formatted }}руб.</span>
                            <span v-if="inquiryShow.price_to">до @{{ inquiryShow.price_to_formatted }}руб.</span>
                            <span v-if="! inquiryShow.price_from && ! inquiryShow.price_to">-</span>
                        </dd>

                        <dt v-if="inquiryShow.car.info.gear">Привод</dt>
                        <dd v-if="inquiryShow.car.info.gear"><span>@{{ inquiryShow.car.info.gear }}</span></dd>
                    </dl>
                    <hr>
                    <p class="text-uppercase text-center text-l">Пользователь:</p>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <img v-attr="src: inquiryShow.user.avatar" class="data-avatar">
                            <span>@{{ inquiryShow.user.name }}</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div v-if="inquiryShow.user.email"><i class="fa fa-envelope"></i> : @{{ inquiryShow.user.email }}</div>
                            <div v-if="inquiryShow.user.phone"><i class="fa fa-phone"></i> : @{{ inquiryShow.user.phone }}</div>
                            <div>
                                <i class="fa fa-globe"></i> : @{{ inquiryShow.city.name }}<span v-if="inquiryShow.metro">, метро @{{ inquiryShow.metro }}</span><span v-if="inquiryShow.street">, ул. @{{ inquiryShow.street }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div><i class="fa fa-calendar"></i> Дата объявления: @{{ inquiryShow.created_at }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>