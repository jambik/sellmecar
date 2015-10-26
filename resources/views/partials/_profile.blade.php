<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profileSave') }}" accept-charset="UTF-8" method="POST" id="form_profile" v-on="submit: ajaxFormSubmit($event, profileSaveSuccess)">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="profileModalLabel"><i class="fa fa-user"></i> Данные аккаунта</h4>
                </div>
                <div class="modal-body">
                    <div class="form-status"></div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Имя:</label>
                            <input type="text" name="name" class="form-control" v-model="user.name">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Телефон:</label>
                            <input type="text" name="phone" class="form-control" v-model="user.phone">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" v-model="user.email">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label>Аватарка:</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary form-button">Сохранить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>
                {!! Form::token() !!}
            </form>
        </div>
    </div>
</div>