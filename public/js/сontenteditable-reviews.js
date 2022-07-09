/*=========================== Contenteditable =============================*/

/*======== Вставка br вместо div ====== */

document.execCommand("defaultParagraphSeparator", false, "br");
document.addEventListener('keydown', event => {
    if (event.key === 'Enter') {
        document.execCommand('insertLineBreak')
        event.preventDefault()
    }
})


function escape_text(text) {
    let map = {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'};
    return text.replace(/[&<>"']/g, function (m) {
        return map[m];
    });
}


/*======== Запрет на вставку стилей в текст ====== */

window.addEventListener("paste", function (e) {
    let edit = e.target;
    if (edit.closest('.editor')) {
        e.preventDefault();
        let text = (e.originalEvent || e).clipboardData.getData('text/plain');
        document.execCommand('insertHtml', false, escape_text(text));
    }
});


document.querySelector('.editor').addEventListener("keydown", function (event) {
    if (event.code === 'Backspace') {
        let editor = event.target;
        if (document.querySelector('.editor').innerHTML === '<br>') {
            editor.querySelector('br').remove();
        }
    }
});

// Добавление текста из Contenteditable в Textarea

function addDataTextarea(elem) {
    document.querySelector('#sendTextArea').innerHTML = elem.innerHTML;
}


// Отправка отзыва на сервер

window.addEventListener('click', function (e) {

        let button = e.target;

        if (button.closest('.send_review')) {

            document.querySelector('.send_review').style.display = 'none';

            e.preventDefault();
            let inputs = '';
            // Получение формы
            let form = button.closest('form');

            let formData = new FormData(form);

            // Отправка на сервер
            let ajax = new XMLHttpRequest();
            ajax.open('POST', form.getAttribute('action'), true)
            ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
            ajax.onload = () => {
                if (ajax.readyState === 4 && ajax.status === 200) {
                    let alert = document.querySelector('.alertReview');
                    let data = JSON.parse(ajax.responseText);
                    if (data['success']) {

                        alert.innerHTML = data['success'];
                        alert.style.color = 'green';
                        document.querySelector('.editor').innerHTML = '';

                    } else {
                        alert.innerHTML = data;
                        alert.style.color = 'red';
                    }
                }
            }
            ajax.send(formData);
            document.querySelector('.send_review').style.display = 'block';
        }
    }
);


// Пагинация отзывов

window.addEventListener('click', function (e) {
    let option = e.target;
    ////  отправка формы на сервер
    if (option.closest('.add-reviews')) {
        e.preventDefault();
        let url = option.getAttribute('data-name');
        let ajax = new XMLHttpRequest();
        ajax.open('GET', url);
        ajax.onload = () => {
            if (ajax.readyState === 4) {
                if (ajax.status === 200) {
                    document.querySelector('#getReviews').innerHTML = ajax.responseText;
                }
            }
        }
        ajax.send();
    }
});
