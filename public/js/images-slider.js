const pageContent = document.querySelector('#pageContent');

pageContent.addEventListener('click', function (e) {

    let boxImages = document.querySelector('.box-form-group-img');
    let elem = e.target;

    if (elem.closest('.add-images')) {

        let indexImages = pageContent.querySelectorAll('.add-block');
        let index = Number(indexImages.length + 1);
        let name = elem.getAttribute('data-name');
        let block = '';

        if (name === 'project-top') {

            block = '' +
                '<div class="add-block">' +
                '<h6 class="mt-5 text-center">слайдер № ' + index + '</h6>' +
                '<div class="row">' +
                '<div class="form-group-img pt-0 col-md-12">' +
                '<label for="image_' + index + '" class="d-flex">' +
                '<div class="mx-auto">(min 970 x 455)' +
                '<span class="required">*</span>' +
                '</div>' +
                '<div class="page-logo">' +
                '<a href="javascript:void(0)" class="sort_by float-right">' +
                '<i style="font-size: 17px" data-id="0" class="delete-images fa fa-trash text-danger" aria-hidden="true"></i>' +
                '<input type="hidden" name="projects" value="">' +
                '</a>' +
                '</div>' +
                '</label>' +
                '<div class="img-box mt-3 mb-3 swiper-project-admin" style="background: url(/upload/default_project_catalog.jpg)no-repeat center/cover">' +
                '<input class="input-img" id="image_' + index + '" type="file" name="image_' + index + '" onchange="loadImageInput(event, this)">' +
                '</div>' +
                '<div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">' +
                '<label for="image_alt_' + index + '">' +
                'описание изображения' +
                '<span class="required">*</span></label>' +
                '<input class="custom_input input_alt" id="image_alt_' + index + '" type="text" name="image_alt_' + index + '" style="height: 25px; font-size: 12px;" value="">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-12">' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_en_' + index + '">' +
                'Заголовок изображения EN' +
                '</label>' +
                '<input class="custom_input" name="title_en_' + index + '" id="title_en_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="description_en_' + index + '">' +
                'Описание EN</label>' +
                '<div class="toolbar">' +
                '<a href="javascript:void(0)" class="toolbar-b" title="Жирный">' +
                '<i class="fa fa-bold" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-i" title="Курсив">' +
                '<i class="fa fa-italic" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-sup" title="Верхний индекс">' +
                '<i class="fa fa-superscript" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-a" title="Ссылка">' +
                '<i class="fa fa-link" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-unlink" title="Удаление ссылки">' +
                '<i class="fa fa-chain-broken" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-selectAll">Выделить всё</a>' +
                '<a href="javascript:void(0)" class="toolbar-removeFormat">Очистить стили</a>' +
                '<a href="javascript:void(0)" class="toolbar-copy" title="Копировать">' +
                '<i class="fa fa-files-o" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-undo" title="Отмена">' +
                '<i class="fa fa-undo" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-redo" title="Повтор">' +
                '<i class="fa fa-repeat" aria-hidden="true"></i>' +
                '</a>' +
                '</div>' +
                '<div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">' +
                '<div class="textEdit">' +
                'Описание...' +
                '</div>' +
                '</div>' +
                '<textarea class="custom_input" name="description_en_' + index + '" id="description_en_' + index + '" type="text" style="display: none">' +
                '</textarea>' +
                '</div>' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_tr_' + index + '">' +
                'Заголовок изображения TR' +
                '</label>' +
                '<input class="custom_input" name="title_tr_' + index + '" id="title_tr_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="description_tr_' + index + '">' +
                'Описание TR</label>' +
                '<div class="toolbar">' +
                '<a href="javascript:void(0)" class="toolbar-b" title="Жирный">' +
                '<i class="fa fa-bold" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-i" title="Курсив">' +
                '<i class="fa fa-italic" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-sup" title="Верхний индекс">' +
                '<i class="fa fa-superscript" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-a" title="Ссылка">' +
                '<i class="fa fa-link" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-unlink" title="Удаление ссылки">' +
                '<i class="fa fa-chain-broken" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-selectAll">Выделить всё</a>' +
                '<a href="javascript:void(0)" class="toolbar-removeFormat">Очистить стили</a>' +
                '<a href="javascript:void(0)" class="toolbar-copy" title="Копировать">' +
                '<i class="fa fa-files-o" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-undo" title="Отмена">' +
                '<i class="fa fa-undo" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-redo" title="Повтор">' +
                '<i class="fa fa-repeat" aria-hidden="true"></i>' +
                '</a>' +
                '</div>' +
                '<div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">' +
                '<div class="textEdit">' +
                'Описание...' +
                '</div>' +
                '</div>' +
                '<textarea class="custom_input" name="description_tr_' + index + '" id="description_tr_' + index + '" type="text" style="display: none">' +
                '</textarea>' +
                '</div>' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_ru_' + index + '">' +
                'Заголовок изображения RU' +
                '</label>' +
                '<input class="custom_input" name="title_ru_' + index + '" id="title_ru_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="description_ru_' + index + '">' +
                'Описание RU</label>' +
                '<div class="toolbar">' +
                '<a href="javascript:void(0)" class="toolbar-b" title="Жирный">' +
                '<i class="fa fa-bold" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-i" title="Курсив">' +
                '<i class="fa fa-italic" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-sup" title="Верхний индекс">' +
                '<i class="fa fa-superscript" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-a" title="Ссылка">' +
                '<i class="fa fa-link" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-unlink" title="Удаление ссылки">' +
                '<i class="fa fa-chain-broken" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-selectAll">Выделить всё</a>' +
                '<a href="javascript:void(0)" class="toolbar-removeFormat">Очистить стили</a>' +
                '<a href="javascript:void(0)" class="toolbar-copy" title="Копировать">' +
                '<i class="fa fa-files-o" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-undo" title="Отмена">' +
                '<i class="fa fa-undo" aria-hidden="true"></i>' +
                '</a>' +
                '<a href="javascript:void(0)" class="toolbar-redo" title="Повтор">' +
                '<i class="fa fa-repeat" aria-hidden="true"></i>' +
                '</a>' +
                '</div>' +
                '<div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">' +
                '<div class="textEdit">' +
                'Описание...' +
                '</div>' +
                '</div>' +
                '<textarea class="custom_input" name="description_ru_' + index + '" id="description_ru_' + index + '" type="text" style="display: none">' +
                '</textarea>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '</div>';

        } else if (name === 'project-status') {

            block = '' +
                '<div class="add-block">' +
                '<h6 class="mt-5 text-center">изображения № ' + index + '</h6>' +
                '<div class="row">' +
                '<div class="form-group-img pt-0 col-md-12">' +
                '<label for="image_' + index + '" class="d-flex">' +
                '<div class="mx-auto">(min 382 x 200)' +
                '<span class="required">*</span>' +
                '</div>' +
                '<div class="page-logo">' +
                '<a href="javascript:void(0)" class="sort_by float-right">' +
                '<i style="font-size: 17px" data-id="0" class=" delete-images fa fa-trash text-danger" aria-hidden="true"></i>' +
                '<input type="hidden" name="projects" value="">' +
                '</a>' +
                '</div>' +
                '</label>' +
                '<div class="img-box mt-3 mb-3" style="width: 100%; height: 214px; background: url(/upload/default_project_catalog.jpg)no-repeat center/cover">' +
                '<input class="input-img" id="image_' + index + '" type="file" name="image_' + index + '" onchange="loadImageInput(event, this)">' +
                '</div>' +
                '<div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">' +
                '<label for="image_alt_' + index + '">' +
                'описание изображения' +
                '<span class="required">*</span></label>' +
                '<input class="custom_input input_alt" id="image_alt_' + index + '" type="text" name="image_alt_' + index + '" style="height: 25px; font-size: 12px;" value="">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-12">' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_en_' + index + '">' +
                'Заголовок изображения EN' +
                '</label>' +
                '<input class="custom_input" name="title_en_' + index + '" id="title_en_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="description_en_' + index + '">Описание планировки EN</label>' +
                '<div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">' +
                '<div class="textEdit">' +
                'Описание' +
                '</div>' +
                '</div>' +
                '<textarea class="custom_input" name="description_tr" id="description_tr" type="text" style="display: none">' +
                '</textarea>' +
                '</div>' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_tr_' + index + '">' +
                'Заголовок изображения TR' +
                '</label>' +
                '<input class="custom_input" name="title_tr_' + index + '" id="title_tr_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '<div class="form-group mt-5" style="position: relative">' +
                '<label for="title_ru_' + index + '">' +
                'Заголовок изображения RU' +
                '</label>' +
                '<input class="custom_input" name="title_ru_' + index + '" id="title_ru_' + index + '" type="text" style="height: 35px">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr class="mt-4 mb-4">' +
                '</div>';

        } else if (name === 'apartments' || name === 'pages') {

            block = '' +
                '<div class="add-block">' +
                '<div class="form-group-img pt-0">' +
                '<label for="image_' + index + '" class="d-flex">' +
                '<div class="mx-auto">' +
                '' + index + ' - (min 852 x 568)' +
                '<span class="required">*</span>' +
                '</div>' +
                '<div class="page-logo">' +
                '<a href="javascript:void(0)" class="sort_by float-right">' +
                '<i style="font-size: 17px" data-id="0" class="delete-images fa fa-trash text-danger" aria-hidden="true"></i>' +
                '</a>' +
                '</div>' +
                '</label>' +
                '<div class="img-box mt-3 mb-3" style="width: 100%; height: 173px; background: url(/upload/default_project_catalog.jpg)no-repeat center/cover">' +
                '<input class="input-img" id="image_' + index + '" type="file" name="image_' + index + '" onchange="loadImageInput(event, this)">' +
                '</div>' +
                '<div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">' +
                '<label for="image_alt_' + index + '">описание изображения<span class="required">*</span> </label>' +
                '<input class="custom_input input_alt" id="image_alt_' + index + '" type="text" name="image_alt_' + index + '" style="height: 25px; font-size: 12px;" value="">' +
                '</div>' +
                '</div>' +
                '</div>';

        } else if (name === 'layouts') {

            block = '' +
                '<div class="add-block">' +
                '<h6 class="mt-5 text-center">планировка № ' + index + '</h6>' +
                '<div class="row">' +
                '<div class="form-group-img pt-0 col-md-6">' +
                '<label for="image_' + index + '" class="d-flex">' +
                '<div class="mx-auto">' + index + ' - (min 260 x 205)<span class="required">*</span>' +
                '</div>' +
                '<div class="page-logo">' +
                '<a href="javascript:void(0)" class="sort_by float-right">' +
                '<i style="font-size: 17px" data-id="0" class="delete-images fa fa-trash text-danger" aria-hidden="true"></i>' +
                '</a>' +
                '</div>' +
                '</label>' +
                '<div class="img-box mt-3 mb-3" style="width: 260px; height: 204px; background: url(/upload/default_project_catalog.jpg)no-repeat center/cover">' +
                '<input class="input-img" id="image_' + index + '" type="file" name="image_' + index + '" onchange="loadImageInput(event, this)">' +
                '</div>' +
                '<div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">' +
                '<label for="image_alt_' + index + '">описание изображения<span class="required">*</span></label>' +
                '<input class="custom_input input_alt" id="image_alt_' + index + '" type="text" name="image_alt_' + index + '" ' +
                'style="height: 25px; font-size: 12px;" value="">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-6 mt-5">' +
                '<div class="form-group" style="position: relative">' +
                '<label for="layout_' + index + '">Планировка<span class="required">*</span></label>' +
                '<select class="custom_input" name="layout_' + index + '" id="layout_' + index + '">' +
                '<option value="0">не выводить</option>' +
                '<option value="1">1 + 1</option>' +
                '<option value="2">2 + 1</option>' +
                '<option value="3">3 + 1</option>' +
                '<option value="4">4 + 1</option>' +
                '<option value="5">5 + 1</option>' +
                '<option value="6">6 + 1</option>' +
                '</select>' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="balcony_' + index + '">Количество балконов</label>' +
                '<input class="custom_input" name="balcony_' + index + '" id="balcony_' + index + '" type="number" value="" placeholder="не выводить">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="quadrature_' + index + '">Квадратура<span class="required">*</span></label>' +
                '<input type="number" class="custom_input" name="quadrature_' + index + '" id="quadrature_' + index + '" placeholder="не выводить">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="bathroom_' + index + '">Количество санузлов</label>' +
                '<input class="custom_input" name="bathroom_' + index + '" id="bathroom_' + index + '" type="number" value="" placeholder="не выводить">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '</div>';
        } else if (name === 'progress') {

            block = '' +
                '<div class="add-block">' +
                '<h6 class="mt-5 text-center">шаг №' + index + '</h6>' +
                '<div class="row">' +
                '<div class="form-group-img pt-0 col-md-6">' +
                '<label for="image_' + index + '" class="d-flex">' +
                '<div class="mx-auto">' +
                '' + index + ' - (min 380 x 185)' +
                '<span class="required">*</span>' +
                '</div>' +
                '<div class="page-logo">' +
                '<a href="javascript:void(0)" class="sort_by float-right">' +
                '<i style="font-size: 17px" data-id="0" class="delete-images fa fa-trash text-danger" aria-hidden="true"></i>' +
                '<input type="hidden" name="projects/delete-progress/" value="{{ $project->progress[$i]->id }}">' +
                '</a>' +
                '</div>' +
                '</label>' +
                '<div class="img-box mt-3 mb-3" style="width: 360px; height: 176px; background: url(/upload/default_project_catalog.jpg)no-repeat center/cover">' +
                '<input class="input-img" id="image_' + index + '" type="file" name="image_' + index + '" onchange="loadImageInput(event, this)">' +
                '</div>' +
                '<div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">' +
                '<label for="image_alt_' + index + '">описание изображения<span class="required">*</span></label>' +
                '<input class="custom_input input_alt" id="image_alt_' + index + '" type="text" ' +
                'name="image_alt_' + index + '" style="height: 25px; font-size: 12px;" value="">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-6 mt-3">' +
                '<div class="form-group" style="position: relative">' +
                '<label for="title_img_en_' + index + '" style="color: #1a202c">Заголовок изображения EN</label>' +
                '<input class="custom_input" name="title_img_en_' + index + '" id="title_img_en_' + index + '" type="text">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="title_img_tr_{{ $i + 1 }}" style="color: #1a202c">Заголовок изображения TR</label>' +
                '<input class="custom_input" name="title_img_tr_' + index + '" id="title_img_tr_' + index + '" type="text">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="title_img_ru_' + index + '" style="color: #1a202c">Заголовок изображения RU</label>' +
                '<input class="custom_input" name="title_img_ru_' + index + '" id="title_img_ru_' + index + '" type="text">' +
                '</div>' +
                '<div class="form-group" style="position: relative">' +
                '<label for="date_' + index + '">Дата</label>' +
                '<input class="custom_input" name="date_' + index + '" id="date_' + index + '" type="date" placeholder="не выводить">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<hr>' +
                '</div>';

        }


        if (indexImages.length === 0) {

            boxImages.innerHTML += block;

        } else {
            indexImages[indexImages.length - 1].insertAdjacentHTML('afterEnd', block)
        }

        // boxImages.innerHTML += apartmentsBlock;
    } else if (elem.closest('.delete-images')) {

        if (elem.getAttribute('data-id') === '0') {
            elem.closest('.add-block').remove();
            return;
        }
        let url = elem.nextElementSibling.name;
        let id = elem.nextElementSibling.value;
        deleteImages(url, id);
    }
})

// Delete image slide

function deleteImages(url, id) {
    let page = document.querySelector('#currentPage');
    let page_id = page.value;
    let result = false;
    let showComponent = page.name;

    let ajax = new XMLHttpRequest();
    ajax.open('GET', '/admin/' + url + '' + id + '', false)
    ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
    ajax.onload = () => {
        if (ajax.readyState === 4 && ajax.status === 200) {
            // stopPreload()
            let data = JSON.parse(ajax.responseText);
console.log(showComponent);
            if (data['success']) {
                addComponents('' + showComponent + '', page_id)
                getAlert('success', data['success']);
            } else {
                getAlert('danger', data);
            }

        }
        if (this.status === 500) {
            // getAlert('danger', 'Что-то пошло не так(((');
        }
    }
    ajax.send();
    return result;
}
