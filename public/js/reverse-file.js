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
