<div class="modal fade" id="pageShowModal" tabindex="-1" role="dialog" aria-labelledby="pageShowModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="pageShowModalLabel"> @{{ pageShow.title }}</h4>
            </div>
            <div class="modal-body">
                <div class="inquiry-show">
                    @{{{ pageShow.text }}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>