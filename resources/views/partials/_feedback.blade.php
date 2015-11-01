<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="feedbackModalLabel"><i class="fa fa-envelope-o"></i> Обратная связь</h4>
            </div>
            <div class="modal-body">
                <form action="/feedback" accept-charset="UTF-8" method="POST" id="form_feedback" v-on="submit: ajaxFormSubmit($event, feedbackSaveSuccess)">
                    <div class="form-status"></div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Имя">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Телефон">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" placeholder="Сообщение" cols="5" style="min-height: 100px;"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block form-button">Отправить сообщение</button>
                    </div>
                    {!! Form::token() !!}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>