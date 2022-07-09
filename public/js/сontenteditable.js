window.addEventListener('click', function (e) {

    let toolbar = e.target;

    // Жирный (b)
    if (toolbar.closest('.toolbar-b')) {
        document.execCommand('bold', false, null);
        return false;
    }

    // Курсив (i)
    if (toolbar.closest('.toolbar-i')) {
        document.execCommand('italic', false, null);
        return false;
    }

    // // Подчёркнутый текст (u)
    // if (toolbar.closest('.toolbar-u')) {
    //     document.execCommand('underline', false, null);
    //     return false;
    // }
    //
    // // Зачёркнутый текст (strike)
    // if (toolbar.closest('.toolbar-s')) {
    //     document.execCommand('strikethrough', false, null);
    //     return false;
    // }

    // Верхний индекс (sup)
    if (toolbar.closest('.toolbar-sup')) {
        document.execCommand('superscript', false, null);
        return false;
    }

    // // Нижний индекс (sub)
    // if (toolbar.closest('.toolbar-sub')) {
    //     document.execCommand('subscript', false, null);
    //     return false;
    // }

    // Маркированный список (ul)
//     if (toolbar.closest('.toolbar-ul')) {
//         document.execCommand('insertUnorderedList', false, null);
//         return false;
//     }
//
// // Нумерованный список (ol)
//     if (toolbar.closest('.toolbar-ol')) {
//         document.execCommand('insertOrderedList', false, null);
//         return false;
//     }
//
//     // Параграф (p)
//     if (toolbar.closest('.toolbar-p')) {
//         document.execCommand('formatBlock', false, 'p');
//         return false;
//     }

//     if (toolbar.closest('.toolbar-p')) {
// // Заголовок (h1)
//         $('body').on('click', '.toolbar-h1', function () {
//             document.execCommand('formatBlock', false, 'h1');
//             return false;
//         });
//     }

    // Горизонтальная линия (hr)
    // if (toolbar.closest('.toolbar-hr')) {
    //     document.execCommand('insertHorizontalRule', false, null);
    //     return false;
    // }

    // // Цитата (blockquote)
    // if (toolbar.closest('.toolbar-blockquote')) {
    //     document.execCommand('formatBlock', false, 'blockquote');
    //     return false;
    // }

    // Ссылка (a)
    if (toolbar.closest('.toolbar-a')) {
        let url = prompt('Введите URL', '');
        document.execCommand('CreateLink', false, url);
        return false;
    }

    // Удаление ссылки
    if (toolbar.closest('.toolbar-unlink')) {
        document.execCommand('unlink', false, null);
        return false;
    }


    // // Выравнивание текста по левому краю
    // if (toolbar.closest('.toolbar-left')) {
    //     document.execCommand('justifyLeft', false, null);
    //     return false;
    // }
    //
    // // Выравнивание текста по центру
    // if (toolbar.closest('.toolbar-center')) {
    //     document.execCommand('justifyCenter', false, null);
    //     return false;
    // }
    //
    // // Выравнивание текста по правому краю
    // if (toolbar.closest('.toolbar-right')) {
    //     document.execCommand('justifyRight', false, null);
    //     return false;
    // }
    //
    // // Выравнивание по ширине
    // if (toolbar.closest('.toolbar-justify')) {
    //     document.execCommand('justifyFull', false, null);
    //     return false;
    // }

    // Отмена
    if (toolbar.closest('.toolbar-undo')) {
        document.execCommand('undo', false, null);
        return false;
    }

    // Повтор
    if (toolbar.closest('.toolbar-redo')) {
        document.execCommand('redo', false, null);
        return false;
    }

    // // Удалить
    // if (toolbar.closest('.toolbar-delete')) {
    //     document.execCommand('delete', false, null);
    //     return false;
    // }

    // Выделить всё
    if (toolbar.closest('.toolbar-selectAll')) {
        document.execCommand('selectAll', false, null);
        return false;
    }

    // Очистить стили
    if (toolbar.closest('.toolbar-removeFormat')) {
        document.execCommand('removeFormat', false, null);
        return false;
    }

    // Вырезать
    // if (toolbar.closest('.toolbar-cut')) {
    //     document.execCommand('cut', false, null);
    //     return false;
    // }

    // Копировать
    if (toolbar.closest('.toolbar-copy')) {
        document.execCommand('copy', false, null);
        return false;
    }
});


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

window.addEventListener("keydown", function (event) {

    if (event.code === 'Backspace') {
        if (event.target.classList.contains('editor')) {

            if (event.target.querySelector('.textEdit').innerHTML === '<br>') {
                event.target.querySelector('.textEdit').innerHTML = 'Описание...';
            }
        }
    }
});


