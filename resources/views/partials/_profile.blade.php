<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profileSave') }}" accept-charset="UTF-8" enctype="multipart/form-data" method="POST" id="form_profile" v-on="submit: ajaxFormSubmit($event, profileSaveSuccess)">
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
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <div class="upload-status"></div>

                            <!-- Current avatar -->
                            <div class="avatar-current" id="avatar_current">
                                <label>Аватарка:</label>
                                <div class="avatar-view" title="Изменить аватарку">
                                    <img class="img-thumbnail" src="{{ Auth::check() && Auth::user()->avatar ? Auth::user()->avatar : '/img/avatar.png' }}">
                                    &nbsp;
                                    <button type="button" class="btn btn-sm btn-default" v-on="click: avatarSelect">Изменить аватарку <i class="fa fa-upload"></i></button>
                                </div>

                                <!-- Upload image and data -->
                                <div class="avatar-upload">
                                    <input type="hidden" name="avatar_data" id="avatar_data">
                                    <input type="file" accept="image/*" id="avatar_file" name="avatar_file" style="display: none;" v-on="change: avatarSelected">
                                </div>
                            </div>

                            <!-- Crop and preview -->
                            <div class="row" id="avatar_cropper" data-upload-url="{{ route('avatarSave') }}" style="display: none;">
                                <div class="col-sm-12 text-center lead">
                                    <i class="fa fa-image"></i> Редактирование новой аватарки
                                </div>
                                <div class="col-sm-8">
                                    <div class="avatar-wrapper" id="avatar_wrapper"></div>
                                    <div>&nbsp;</div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-sm btn-success upload-button" v-on="click: avatarUpload">Сохранить аватарку <i class="fa fa-check-square-o"></i></button>
                                        <button type="button" class="btn btn-sm btn-warning" v-on="click: cancelAvatarUpload">Отмена <i class="fa fa-remove"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
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