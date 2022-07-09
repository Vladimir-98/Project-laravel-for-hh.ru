<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window">×</span>
        <div class="card-form">
            <div class="form">
                <div class="box-form-group-img card-grid-trio">
                    <div class="form-group-img">
                        <label for="img">
                            Слайдер
                        </label>
                        <div class="img-box" style="width: 180px">
                            <input class="input-img" type="file" name="logo" id="img">
                            <img src="/upload/default_game.jpg" alt="">
                        </div>
                    </div>
                    <div class="form-group-img">
                        <label for="img">
                            Изображение каталога
                        </label>
                        <div class="img-box" style="width: 140px">
                            <input class="input-img" type="file" name="logo" id="img">
                            <img src="/upload/default_game.jpg" alt="">
                        </div>
                    </div>
                    <div class="form-group-img post">
                        <label for="img">
                            Изображение карточки
                        </label>
                        <div class="img-box post" style="width: 100px">
                            <input class="input-img" type="file" name="logo" id="img">
                            <img src="/upload/default_game.jpg" alt="">
                        </div>
                    </div>
                    <div class="form-group-img logo">
                        <label for="img">
                            Лого
                        </label>
                        <div class="img-box" style="width: 60px">
                            <input class="input-img" type="file" name="logo" id="img">
                            <img src="/upload/default_game.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="form-group" style="position: relative">
                    <label for="qq">
                        Название
                    </label>
                    <input class="custom_input" id="qq" type="text" name="email">
                </div>
                <div class="card-grid-trio" id="contentProject">
                    <div class="form-group" style="position: relative">
                        <label for="email">
                            Район
                        </label>
                        <div class="select">
                            <select class="custom_input" id="email" type="email" name="email">
                                <option value="">Тедже1</option>
                                <option value="">Тедже2</option>
                                <option value="">Тедже3</option>
                                <option value="">Тедже4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="цц">
                            Айдат
                        </label>
                        <input class="custom_input" id="цц" type="number" name="email" required="required" autofocus="autofocus">
                    </div>
                    <div class="form-group">
                        <label for="email">
                            Расстояние до моря
                        </label>
                        <input class="custom_input" id="email" type="number" name="email" required="required"
                               autofocus="autofocus">

                    </div>
                    <div class="form-group">
                        <label for="email">
                            Газ
                        </label>
                        <div class="select">
                            <select class="custom_input" id="email" type="email" name="email" required="required"
                                    autofocus="autofocus">
                                <option value="">Есть</option>
                                <option value="">Нет</option>
                                <option value="">Будет</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="цц">
                            Наличие квартир
                        </label>
                        <input class="custom_input" id="цц" type="number" name="email" required="required"
                               autofocus="autofocus">

                    </div>
                    <div class="form-group">
                        <label for="email">
                            Цена минимальная
                        </label>
                        <input class="custom_input" id="email" type="number" name="email" required="required"
                               autofocus="autofocus">

                    </div>
                    <div class="form-group">
                        <label for="email">
                            Срок сдачи
                        </label>
                        <input class="custom_input" id="цц" type="date" name="email" required="required"
                               autofocus="autofocus">

                    </div>
                    <div class="form-group">
                        <label for="цц">
                            Наличие квартир
                        </label>
                        <input class="custom_input" id="цц" type="number" name="email">

                    </div>
                    <div class="form-group">
                        <label for="email">
                            Квадратура от
                        </label>
                        <input class="custom_input" id="email" type="number" name="email" required="required" autofocus="autofocus">

                    </div>
                </div>

                <div class="footer-modal">
                    <div class="d-flex">
                        <a class="admin-btn-box" href="javascript:void(0)" onclick="getPopupCategory()">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span>Добавить описание</span>
                        </a>

                        <div class="popup popup-admin" id="popupAddCategory">
                            <input class="custom_input" type="text">
                            <a class="btn btn-blue" href="javascript:void(0)" onclick="addDescriptionProject(this)">
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </a>
                            <span class="close_modal_window close_popup" onclick="closePopup(this)">×</span>
                        </div>

                        <button type="submit" class="btn btn-white">
                            отмена
                        </button>
                        <button type="submit" class="btn btn-blue">
                            сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
