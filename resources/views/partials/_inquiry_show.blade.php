<div class="modal fade" id="inquiryShowModal" tabindex="-1" role="dialog" aria-labelledby="inquiryShowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inquiryShowModalLabel"><i class="fa fa-list"></i> Объявление #@{{ inquiryShow.inquiry.id }}</h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    <p class="text-uppercase text-center text-l">Параметры автомобиля:</p>
                    <dl class="dl-horizontal">
                        <dt>Марка</dt>
                        <dd>@{{ inquiryShow.inquiry.car.name }}</dd>

                        <dt>Модель</dt>
                        <dd>@{{ inquiryShow.inquiry.model }}</dd>

                        <dt>Трансмиссия</dt>
                        <dd>@{{ inquiryShow.inquiry.transmission_name }}</dd>

                        <dt>Года</dt>
                        <dd>
                            <span v-if="inquiryShow.inquiry.year_from">с @{{ inquiryShow.inquiry.year_from }}г.</span>
                            <span v-if="inquiryShow.inquiry.year_to">по @{{ inquiryShow.inquiry.year_to }}г.</span>
                            <span v-if="! inquiryShow.inquiry.year_from && ! inquiryShow.inquiry.year_to">-</span>
                        </dd>

                        <dt>Цена</dt>
                        <dd>
                            <span v-if="inquiryShow.inquiry.price_from">от @{{ inquiryShow.inquiry.price_from_formatted }}руб.</span>
                            <span v-if="inquiryShow.inquiry.price_to">до @{{ inquiryShow.inquiry.price_to_formatted }}руб.</span>
                            <span v-if="! inquiryShow.inquiry.price_from && ! inquiryShow.inquiry.price_to">-</span>
                        </dd>
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
                        </div>
                    </div>
                    <hr>
                    <div><i class="fa fa-calendar"></i> Дата объявления: @{{ inquiryShow.inquiry.created_at }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>