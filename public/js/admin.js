// Gamburger admin
function getGamburger(gamburger) {
    let panelAdmin = document.querySelector('#panelAdmin');
    let panelAdminMenu = document.querySelector('#panelAdminMenu');
    let menuWidthAfter = '300px';
    let menuWidthBefore = '72px';
    let menuBackgroundAfter = 'transparent';
    let opacity = '0';
    let display = 'none';

    gamburger.classList.toggle('open');

    if (gamburger.classList.contains('open')) {
        menuWidthAfter = '72px';
        menuWidthBefore = '300px';
        menuBackgroundAfter = '#22273d';
        opacity = '1';
        display = 'block';
    }

    panelAdmin.animate([
        {width: menuWidthAfter},
        {width: menuWidthBefore}
    ], {duration: 70,});

    setTimeout(() => {
        panelAdmin.style.width = menuWidthBefore;
        panelAdmin.style.backgroundColor = menuBackgroundAfter;
    }, 70);

    setTimeout(() => {
        panelAdminMenu.style.opacity = opacity;
        panelAdminMenu.style.display = display;
    }, 60);

}

// Popup ???????????????????????

let popupAddCategory = document.querySelector('#popupAddCategory');

function getPopupCategory() {
    setTimeout(() => {
        popupAddCategory.style.display = 'flex';
    }, 60);
}

function closePopup(elem) {
    elem.closest('.popup').style.display = 'none';
}

// Add category description ???????????????????????

function addDescriptionProject(elem) {
    let inputValue = elem.previousElementSibling;
    let contentProject = document.querySelector('#contentProject');
    let block = '' +
        '<div class="form-group"><label>' + inputValue.value + '</label><input class="custom_input" type="text"></div>';
    if (inputValue.value === '') {
        return
    }
    setTimeout(() => {
        contentProject.innerHTML += block;
        inputValue.value = '';
    }, 60);

    closePopup(elem)
}


// Алерты

const alertTop = document.querySelector('.alert-top');
const alert = document.querySelector('.alert');

function getAlert(color, data) {

    alert.classList.add('alert-' + color + '');
    alert.innerHTML = data;

    if (data !== '') {
        alertTop.style.display = 'block';

        setTimeout(() => {
            alertTop.style.display = 'none';
            alert.classList.remove('alert-' + color + '');
        }, 2500);
    }
}

const preloadAlert = document.querySelector('.alert-preload');

function getPreload() {
    // setTimeout(() => {
    preloadAlert.style.display = 'block';
    // }, 200);

}

function stopPreload() {
    preloadAlert.style.display = 'none';
}

// Вызов модалки

function getModalAdmin(url, elem) {
    let ajax = new XMLHttpRequest();
    ajax.open('GET', url);
    ajax.onload = () => {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                let modalElem = document.querySelector('#modalPage');

                modalElem.innerHTML = ajax.response;

                let newNotification = modalElem.querySelector('#notification');
                let notification = document.querySelector('.notification');
                if (newNotification && newNotification.value && notification) {

                    if (elem.hasAttribute('data-id')) {
                        document.querySelector('#' + elem.getAttribute('data-id') + '').style.color = '#6c6c6c';
                        document.querySelector('#' + elem.getAttribute('data-id') + '').style.fontWeight = '100';
                    }
                    let countReview = newNotification.value;
                    countReview === '0' ? notification.remove() : notification.innerHTML = countReview;
                }
            }
        }
    }
    ajax.send();
}

// Модалка для удаления компонентов
const deleteModal = document.querySelector('#delete_modal');
const deleteForm = document.querySelector('#deleteForm');
const idComponent = document.querySelector('#idComponent');

function getDeleteModalAdmin(url, id) {

    deleteModal.style.display = 'block';
    deleteForm.action = url;
    idComponent.value = id;

}


// Удаление компонентов
// const pageContent = document.querySelector('#pageContent');

pageContent.addEventListener('click', function (e) {

    let button = e.target;
    if (button.closest('.close_modal_delete')) {
        deleteModal.style.display = "none";
        deleteForm.action = '';
        idComponent.value = '';

    } else if (button.closest('.btn_delete_component')) {
        getPreload();
        let formData = new FormData(deleteForm);
        // Отправка на сервер
        let ajax = new XMLHttpRequest();
        ajax.open('POST', deleteForm.getAttribute('action'), true)
        // ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
        ajax.onload = () => {
            if (ajax.readyState === 4 && ajax.status === 200) {
                stopPreload()
                let data = JSON.parse(ajax.responseText);
                button.removeAttribute('disabled');
                // Успешно
                if (data['success']) {
                    let deletePageComponentId = document.querySelector('#deletePageComponentId').value;

                    getAlert('success', data['success']);
                    deleteModal.style.display = "none";
                    addComponents(data['component'], deletePageComponentId)
                    // Ошибка
                } else {

                    getAlert('danger', data);

                }
            }
            if (this.status === 500) {
                getAlert('danger', 'Что-то пошло не так(((');
            }
        }
        ajax.send(formData);
    }
})


// Отправка формы на сервер

const modalPage = document.querySelector('#modalPage');

modalPage.addEventListener('click', function (e) {

        let button = e.target;

        ////  отправка формы на сервер
        if (button.closest('.form_btn')) {

            button.setAttribute('disabled', 'disabled');

            getPreload()
            e.preventDefault();
            let inputs = '';
            // Получение формы
            let form = button.closest('form');
            let formData = new FormData(form);

            if (form.querySelector('#youtube') != null) {
                let iframe = form.querySelector('#youtube').value;
                let src = getSrcIframe(iframe);
                if (src) {
                    formData.append('youtube', src);
                }
            }
            if (form.querySelector('#urlMap') != null) {
                let iframe = form.querySelector('#urlMap').value;
                let src = getSrcIframe(iframe);
                if (src) {
                    formData.append('url', src);
                }
            }

            // Сортировка
            let page = document.querySelector('#currentPage');
            let page_id = page.value;
            let categoryPage = page.name;
            let currentSortId = document.querySelector('#currentSortId').value;

            // Отправка на сервер
            let ajax = new XMLHttpRequest();
            ajax.open('POST', form.getAttribute('action'), true)
            ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
            ajax.onload = () => {
                if (ajax.readyState === 4 && ajax.status === 200) {

                    stopPreload()

                    let data = JSON.parse(ajax.responseText);
                    button.removeAttribute('disabled');
                    // Успешно
                    if (data['success']) {

                        getAlert('success', data['success']);

                        // Загрузка таблицы
                        // if (data['page'] && data['sort']) {
                        //     page_id = data['page'];
                        //     currentSortId = data['sort'];
                        // }
                        if (categoryPage === 'slider'
                            || categoryPage === 'status'
                            || categoryPage === 'meta'
                            || categoryPage === 'map'
                            || categoryPage === 'description'
                            || categoryPage === 'video'
                            || categoryPage === 'plan'
                            || categoryPage === 'layouts-slider'
                            || categoryPage === 'infrastructure'
                            || categoryPage === 'progress'
                            || categoryPage === 'page-slider'
                            || categoryPage === 'about'
                            || categoryPage === 'design'
                            || categoryPage === 'header'
                            || categoryPage === 'review'
                            || categoryPage === 'page-slider'
                            || categoryPage === 'page-title'
                        ) {

                            let pageComponent = document.querySelector('#pageComponent').name;

                            addComponents(categoryPage, page_id);

                        } else {
                            // загрузка table
                            fetchData(page_id, categoryPage, currentSortId);

                            setTimeout(() => {
                                modalPage.firstElementChild.style.display = 'none';
                            }, 200);
                        }
                        // Ошибка
                    } else {
                        getAlert('danger', data);
                    }
                }
                if (this.status === 500) {
                    getAlert('danger', 'Что-то пошло не так(((');
                }
            }

            ajax.send(formData);
        }

        //// Закрыть форму

        if (button.closest('.close_modal')) {

            let modal = button.closest('#my_modal');
            modal.style.display = "none";

        }

        if (button.closest(".custom-checkbox")) {
            if (button.classList.contains('checked')) {
                button.classList.remove('checked');
                button.value = '0'
            } else {
                button.classList.add('checked');
                button.value = '1'
            }
        }
    }
);

// getSrcIframeYoutubeMap...
function getSrcIframe(iframe) {
    let src = false;
    let iframeHtml = new DOMParser().parseFromString(iframe, 'text/html');
    if (iframeHtml.querySelector('iframe') != null) {
        src = iframeHtml.querySelector('iframe').src;
        return src;
    }
}

// Добавление текста из Contenteditable в Textarea

function addDataTextarea(elem) {
    let textEdit = elem.querySelector('.textEdit');
    let textArea = elem.nextElementSibling;

    if (textEdit.innerHTML === '<br>' || textEdit.innerHTML === 'Описание...' || textEdit.innerHTML === 'Ответ...') {
        textArea.innerHTML = '';
    } else {
        textArea.innerHTML = textEdit.innerHTML;
    }

}

// Выбор района

modalPage.addEventListener('click', function (e) {

    let option = e.target;
    ////  отправка формы на сервер
    if (option.closest('.option_city')) {
        e.preventDefault();
        let city_id = option.value;
        let ajax = new XMLHttpRequest();
        ajax.open('GET', 'districts/show-all?city_id=' + city_id);
        ajax.onload = () => {
            if (ajax.readyState === 4) {
                if (ajax.status === 200) {
                    document.querySelector('#selectDistrict').innerHTML = ajax.responseText;
                }
            }
        }
        ajax.send();
    }
});

// Paginate - Sort

document.querySelector('#pageContent').addEventListener('click', function (e) {

    let pageSort = e.target;

    if (pageSort.closest('.page-link')) {
        let currentSortId = document.querySelector('#currentSortId').value;
        let page = document.querySelector('#currentPage');
        let categoryPAge = page.name;
        e.preventDefault();
        if (pageSort.hasAttribute('href')) {
            page = pageSort.getAttribute('href').split('page=')[1];
            fetchData(page, categoryPAge, currentSortId);
        } else {
            return
        }

    } else if (pageSort.closest('.sort_id')) {

        if (currentSortId === 'asc') {
            currentSortId = 'desc';
        } else {
            currentSortId = 'asc';
        }
        fetchData(page.value, categoryPAge, currentSortId);
    }

}, false);

// Get data table

function fetchData(page, url, currentSortId) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '' + url + '/table?page=' + page + '&sort_id=' + currentSortId);
    xhr.onload = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.querySelector('#tableData').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

//addComponents

function addComponents(url, page_id) {

    let xhr = new XMLHttpRequest();

    xhr.open('GET', url + '/' + page_id);
    xhr.onload = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                document.querySelector('#componentsPage').innerHTML = xhr.response;
            }
        }
    }
    xhr.send();
}

// Load Images Input

let loadImageInput = function (event, elem) {

    let reader = new FileReader();

    reader.onload = function () {

        if (elem.hasAttribute('data-id')) {                         // Для общей загрузки фото

            let dataId = elem.getAttribute('data-id');

            let outputs = document.querySelectorAll('.' + dataId + '');

            for (let i = 0; i < outputs.length; i++) {

                outputs[i].style.backgroundImage = 'url(' + reader.result + ')';
            }

        } else {                                                                // Для одиночной загрузки фото
            let output = elem.closest('.img-box');
            output.style.backgroundImage = 'url(' + reader.result + ')';
        }

    };
    reader.readAsDataURL(event.target.files[0]);

};

// SideBarDropdown

function getSidebarDropdown(currElem, color) {

    let navigationDropdown = currElem.nextElementSibling;
    let icon = currElem.firstElementChild;
    let svgDown = 'url(/upload/svg/down-dropdown' + color + '.svg)';
    let topBefore = '46px';
    let topAfter = '40px';


    if (!navigationDropdown.classList.contains('active')) {
        svgDown = 'url(/upload/svg/up-dropdown' + color + '.svg)';
        topBefore = '44px';
        topAfter = '46px';
        navigationDropdown.style.display = 'block';
        navigationDropdown.classList.add('active');
        // document.body.style.overflow = 'hidden';
    } else {
        setTimeout(() => {
            navigationDropdown.style.display = 'none';
        }, 50);
        navigationDropdown.classList.remove('active');
        // document.body.style.overflow = 'auto';
    }

    navigationDropdown.animate([
        {top: topBefore},
        {top: topAfter}
    ], {
        duration: 50
    });

    setTimeout(() => {
        icon.style.backgroundImage = svgDown;
    }, 30);

    // navigationDropdown.style.top = topBefore;

}

