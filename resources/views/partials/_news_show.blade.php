<div class="modal fade" id="newsShowModal" tabindex="-1" role="dialog" aria-labelledby="newsShowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="newsShowModalLabel">@{{ newsShow.title }}</h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    @{{{ newsShow.text }}}
                    <hr>
                    <div><i class="fa fa-calendar"></i> Дата : @{{ newsShow.published_at }}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>