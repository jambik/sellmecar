<div class="modal fade" id="inquiriesModal" tabindex="-1" role="dialog" aria-labelledby="inquiriesModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 900px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="inquiriesModalLabel"><i class="fa fa-list"></i> Ваши объявления</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-condensed table-striped" v-if="inquiries.length">
                    <tr>
                        <th>Автомобиль</th>
                        <th>Года</th>
                        <th>Цена</th>
                        <th>Доп. информация</th>
                        <th>&nbsp;</th>
                    </tr>
                    <tr v-repeat="item in inquiries">
                        <td>
                            <span>@{{ item.car.name }}</span>
                            <span v-if="item.model">, @{{ item.model }}</span>
                        </td>
                        <td>
                            <span v-if="item.year_from">с @{{ item.year_from }}г.</span>
                            <span v-if="item.year_to">по @{{ item.year_to }}г.</span>
                            <span v-if="! item.year_from && ! item.year_to">-</span>
                        </td>
                        <td>
                            <span v-if="item.price_from">от @{{ item.price_from_formatted }}руб.</span>
                            <span v-if="item.price_to">до @{{ item.price_to_formatted }}руб.</span>
                            <span v-if="! item.price_from && ! item.price_to">-</span>
                        </td>
                        <td>
                            <span v-if="item.information">@{{ item.information }}</span>
                            <span v-if="! item.information">-</span>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" v-on="click: inquiryDelete(item)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </table>
                <p v-if="! inquiries.length">У вас нет объявлений</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>