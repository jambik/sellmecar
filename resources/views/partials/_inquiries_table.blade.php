<div class="modal fade" id="inquiriesModal" tabindex="-1" role="dialog" aria-labelledby="inquiriesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inquiriesModalLabel"><i class="fa fa-list"></i> Ваши объявления</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped" v-if="inquiries.length">
                        <tr>
                            <th>Автомобиль</th>
                            <th>Года</th>
                            <th>Цена</th>
                            <th>Доп. информация</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr v-repeat="item in inquiries">
                            <td>
                                <span>@{{ item.car.name }}</span>
                                <span v-if="item.model">, @{{ item.model }}</span>
                            </td>
                            <td>
                                <span v-if="item.year_from > 0">с @{{ item.year_from }}г.</span>
                                <span v-if="item.year_to > 0">по @{{ item.year_to }}г.</span>
                                <span v-if="item.year_from == 0 && item.year_to == 0">-</span>
                            </td>
                            <td>
                                <span v-if="item.price_from > 0">от @{{ item.price_from_formatted }} ₽</span>
                                <span v-if="item.price_to > 0">до @{{ item.price_to_formatted }} ₽</span>
                                <span v-if="item.price_from == 0 && item.price_to == 0">-</span>
                            </td>
                            <td>
                                <span v-if="item.information">@{{ item.information }}</span>
                                <span v-if="! item.information">-</span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm" title="Редактировать объявление" v-on="click: inquiryDelete(item)"><i class="fa fa-pencil-square-o"></i></button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" title="Удалить объявление" v-on="click: inquiryDelete(item)"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <p v-if="! inquiries.length">У вас нет объявлений</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>