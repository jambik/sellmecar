<div class="modal fade" id="newsShowModal" tabindex="-1" role="dialog" aria-labelledby="newsShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newsShowModalLabel">@{{ newsShow.title ? newsShow.title : 'Загрузка новости...' }}</h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    @{{{ newsShow.text }}}
                    <hr>
                    <div><i class="fa fa-calendar"></i> Дата : @{{ newsShow.published_at }}</div>
                </div>

                <div>&nbsp;</div>
                <nav>
                    <ul class="pager">
                        <li class="previous"><a href="#" v-on="click: moveNews($event)"><span aria-hidden="true">&larr;</span> Предыдущая новость</a></li>
                        <li class="next"><a href="#" v-on="click: moveNews($event)">Следующая новость <span aria-hidden="true">&rarr;</span></a></li>
                    </ul>
                </nav>
                <div>&nbsp;</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>