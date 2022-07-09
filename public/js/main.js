// Вызов модалки обратной связи
const formModal = document.querySelector('#formModal');
const backgroundModal = document.querySelector('.background_modal');

function getModalForm() {
    formModal.animate([
        {top: '-600px', opacity: '0'},
        {top: '60px', opacity: '1'}
    ], {
        duration: 100
    });
    backgroundModal.animate([
        {opacity: '0'},
        {opacity: '1'}
    ], {
        duration: 100
    });

    formModal.style.display = 'block';
    formModal.style.top = '60px'
    formModal.style.opacity = '1'
    backgroundModal.style.display = 'block';
    backgroundModal.style.opacity = '1'
}

window.addEventListener('click', function (e) {
    let modal = e.target;
    if ((modal.closest('.modal') && !modal.closest('.modal_content')) || modal.closest('.close_modal')) {
        closeModal();
    }
});


function closeModal(){
    formModal.style.display = 'none';
    formModal.style.bottom = '-600px'
    backgroundModal.style.opacity = '0'
    backgroundModal.style.display = 'none';
    formModal.style.opacity = '0';
}

// Добавление текста из Contenteditable в Textarea

function addDataTextareaForm(elem) {
    elem.nextElementSibling.innerHTML = elem.innerHTML;
}

const windowInnerWidth = document.documentElement.clientWidth

// SideBarDropdown

function getSidebarDropdown(currElem, color) {

    let navigationDropdown = currElem.nextElementSibling;
    let icon = currElem.firstElementChild;
    let svgDown = 'url(/upload/svg/down-dropdown' + color + '.svg)';
    let topBefore = '46px';
    let topAfter = '40px';

    if (windowInnerWidth > 1023 && !navigationDropdown.classList.contains('nav-link-dropdown')) {
        return
    }

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

function getProfileDropDown(currElem) {

    let dropDown = currElem.firstElementChild;
    let downSvg = currElem.lastElementChild;

    // let navigationDropdown = currElem.nextElementSibling;
    // let icon = currElem.firstElementChild;
    let svgDown = 'url(/upload/svg/down-dropdown.svg)';
    let topBefore = '30px';
    let topAfter = '20px';
    let opacityBefore = '0.7';
    let opacityAfter = '1';

    if (!dropDown.classList.contains('active')) {
        svgDown = 'url(/upload/svg/up-dropdown.svg)';
        topBefore = '20px';
        topAfter = '30px';
        opacityBefore = '1';
        opacityAfter = '0.7';
        dropDown.style.display = 'block';
        dropDown.classList.add('active');
    } else {
        setTimeout(() => {
            dropDown.style.display = 'none';
        }, 50);
        dropDown.classList.remove('active');
    }

    if (currElem.getAttribute('data-name') !== 'avatar') {
        setTimeout(() => {
            downSvg.style.backgroundImage = svgDown;
        }, 25);
    }

    dropDown.animate([
        {top: topBefore},
        {top: topAfter}
    ], {
        duration: 50
    });
}

// Language
function getLinkLang(lang) {
    document.querySelector('.lang-text').innerText = lang;
}


// Scroll
const anchors = document.querySelectorAll('a[href*="#"]')

for (let anchor of anchors) {
    anchor.addEventListener('click', function (e) {
        e.preventDefault()

        const blockID = anchor.getAttribute('href').substr(1)

        document.getElementById(blockID).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    })
}

// animate Page
function onEntry(entry) {
    entry.forEach(change => {
        if (change.isIntersecting) {
            change.target.classList.add('element-show');
        }
    });
}

let options = {
    threshold: [0.5]
};
let observer = new IntersectionObserver(onEntry, options);
let elements = document.querySelectorAll('.element-animation');

for (let elm of elements) {
    observer.observe(elm);
}

// getConnectionMenu

function getConnectionMenu() {
    let fixBoxConnection = document.querySelector('#fixBoxConnection');
    let menuDisplay = 'none';
    let menuOpacityBefore = '0';
    let menuOpacityAfter = '1';
    let menuLeftBefore = '-30px';
    let menuLeftAfter = '0';
    if (fixBoxConnection.style.opacity === '1') {
        menuLeftBefore = '0';
        menuLeftAfter = '-30px';
        // menuDisplay = 'block';
        menuOpacityBefore = '1';
        menuOpacityAfter = '0';
    }

    fixBoxConnection.animate([
        {opacity: menuOpacityBefore, left: menuLeftBefore},
        {opacity: menuOpacityAfter, left: menuLeftAfter}
    ], {duration: 70,});

    fixBoxConnection.style.opacity = menuOpacityAfter;
    fixBoxConnection.style.left = menuLeftAfter;
}

// Like
let mainContainer = document.querySelector('.wrapper');

mainContainer.addEventListener('click', (e) => {
    let option = e.target;
    ////  отправка формы на сервер
    if (option.closest('.heart')) {
        let type = option.getAttribute('data-name');
        let id = option.getAttribute('data-id');
        let formData = new FormData();
        formData.append('type', type);
        formData.append('id', id);
        // Отправка на сервер
        let ajax = new XMLHttpRequest();
        ajax.open('POST', '/carts/carts/add-cart', false)
        ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
        ajax.onload = () => {
            if (ajax.readyState === 4 && ajax.status === 200) {
                let data = JSON.parse(ajax.responseText);

                if (data['quantity'] === 0) {
                    document.querySelector('#countCart').innerHTML = data['quantity'];
                    document.querySelector('#countCart').style.display = 'none';
                } else {
                    document.querySelector('#countCart').innerHTML = data['quantity'];
                    document.querySelector('#countCart').style.display = 'block';
                }
                option.src = '/upload/svg/heart-' + data['color_heart'] + '.svg';

                if (option.classList.contains('delete_card_added')) {

                    option.closest('.swiper-slide').remove();
                }
            }
        }
        ajax.send(formData);
    }
});

// Page paginate favourites
mainContainer.addEventListener('click', (e) => {
    let option = e.target;
    if (option.closest('.pagination-page')) {
        let page = option.getAttribute('data-id');
        let url = option.getAttribute('data-name');
        // Отправка на сервер
        let ajax = new XMLHttpRequest();
        ajax.open('GET', url + '?page=' + page, true)
        ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
        ajax.onload = () => {
            if (ajax.readyState === 4 && ajax.status === 200) {
                document.querySelector('.pagination-area').remove();
                document.querySelector('#addedData').innerHTML = ajax.responseText
            }
        }
        ajax.send();
    }
});

// Close agreement

mainContainer.addEventListener('click', (e) => {
    let option = e.target;
    if (option.closest('.close_modal_agreement')) {
        // Отправка на сервер
        let ajax = new XMLHttpRequest();
        ajax.open('GET', '/close-modal-agreement')
        ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
        ajax.onload = () => {
            if (ajax.readyState === 4 && ajax.status === 200) {
                let data = JSON.parse(ajax.responseText);
                if (data['success']) {
                    option.closest('.agreement_modal').style.display = 'none';
                }
            }
        }
        ajax.send();
    }
});

// Slider

document.addEventListener('DOMContentLoaded', () => {
    const width = window.innerWidth
    if (width < 1199) {

        new Swiper('#apartmentDesign', {

            loop: true,
            slidesPerView: 1,
            spaceBetween: 24,
            speed: 800,
            freeMode: true,
            navigation: {
                nextEl: ".header-slider-next",
                prevEl: ".header-slider-prev",
            },

            breakpoints: {
                315: {
                    slidesPerView: 1.1,
                    spaceBetween: 24,
                },
                424: {
                    slidesPerView: 1.4,
                    spaceBetween: 24,
                },
                574: {
                    slidesPerView: 1.9,
                    spaceBetween: 24,
                },
                768: {
                    // loop: false,
                    slidesPerView: 2.2,
                    spaceBetween: 24,
                },

                850: {
                    // loop: false,
                    slidesPerView: 2.5,
                    spaceBetween: 24,
                },
                1024: {
                    // loop: false,
                    slidesPerView: 2.7,
                    spaceBetween: 24,
                    navigation: false
                },

                1199: {
                    loop: false,
                    slidesPerView: 3.3,
                    spaceBetween: 0,
                    navigation: false
                },
            }
        });
    }
})

new Swiper('.news', {

    loop: true,
    speed: 800,
    freeMode: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        315: {
            slidesPerView: 1.1,
            spaceBetween: 15,
        },
        424: {
            slidesPerView: 1.2,
            spaceBetween: 15,
        },
        574: {
            slidesPerView: 1.5,
            spaceBetween: 15,
        },
        768: {
            // loop: false,
            slidesPerView: 2,
            spaceBetween: 15,
        },

        850: {
            loop: false,
            slidesPerView: 2.5,
            spaceBetween: 15,
        },

        1199: {
            loop: false,
            slidesPerView: 3,
            spaceBetween: 32,
        },
    }
});

new Swiper('.projects-cards', {

    loop: true,
    speed: 800,
    spaceBetween: 24,
    freeMode: true,
    slidesPerView: 1.03,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1.035,
            // spaceBetween: 10,
        },
        480: {
            slidesPerView: 1.1,
            // spaceBetween: 15,
        },
        576: {
            slidesPerView: 2,
            // spaceBetween: 5,
        },
        768: {
            // loop: false,
            slidesPerView: 2.3,
            // spaceBetween: 24,
        },

        850: {
            // loop: false,
            slidesPerView: 2.5,
            // spaceBetween: 24,
        },
        1024: {
            // loop: false,
            slidesPerView: 2.7,
            // spaceBetween: 24,
        },

        1199: {
            allowTouchMove: false,
            pagination: false,
            loop: false,
            slidesPerView: false,
            spaceBetween: 0,
        },
    }
});


new Swiper('.apartments-cards', {

    loop: true,
    speed: 800,
    spaceBetween: 24,
    freeMode: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        320: {
            slidesPerView: 1.4,
            // spaceBetween: 10,
        },
        480: {
            slidesPerView: 1.7,
            // spaceBetween: 15,
        },
        576: {
            slidesPerView: 2,
            // spaceBetween: 5,
        },
        768: {
            // loop: false,
            slidesPerView: 2.3,
            // spaceBetween: 24,
        },

        850: {
            // loop: false,
            slidesPerView: 2.5,
            // spaceBetween: 24,
        },
        1024: {
            // loop: false,
            slidesPerView: 2.7,
            // spaceBetween: 24,
        },

        1199: {
            allowTouchMove: false,
            pagination: false,
            loop: false,
            slidesPerView: false,
            spaceBetween: 0,
        },
    }
});


new Swiper(".swiperReview", {
    effect: "cards",
    grabCursor: true,
    loopAdditionalSlides: 12
});


new Swiper('.header-slider-swiper', {

    slidesPerView: 1.4,
    // spaceBetween: 16,/
    centeredMode: true,
    loop: true,
    speed: 800,
    navigation: {
        nextEl: ".header-slider-next",
        prevEl: ".header-slider-prev",
    },
    // loop: true,
    breakpoints: {

        315: {
            slidesPerView: 1,
            spaceBetween: 32,
            loop: false,
        },

        574: {
            slidesPerView: 1.1,
            spaceBetween: 32,
            loop: false,
        },
        // 1200: {
        //     slidesPerView: 1.1,
        //     spaceBetween: 48,
        // },
        1440: {
            slidesPerView: 1.4,
            spaceBetween: 72,
        }
    }

});

new Swiper('.apartment-layout', {

    loop: true,
    slidesPerView: 3.4,
    // spaceBetween: 24,
    speed: 800,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        315: {
            slidesPerView: 1.3,
            spaceBetween: 24,
        },
        424: {
            slidesPerView: 1.5,
            spaceBetween: 24,
        },
        574: {
            loop: true,
            slidesPerView: 2.1,
            spaceBetween: 24,
        },
        768: {
            loop: true,
            slidesPerView: 2.6,
            spaceBetween: 24,
        },

        1199: {
            allowTouchMove: false,
            loop: false,
            slidesPerView: 3.3,
            spaceBetween: 0,
            pagination: true
        },

    }
});

new Swiper('.сonstruction-progress', {

    loop: true,
    slidesPerView: 2,
    spaceBetween: 32,
    speed: 800,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".header-slider-next",
        prevEl: ".header-slider-prev",
    },

    breakpoints: {
        315: {
            slidesPerView: 1,
            spaceBetween: 15,
        },

        574: {
            loop: true,
            slidesPerView: 1.5,
            spaceBetween: 15,

        },
        768: {
            slidesPerView: 1.8,
            spaceBetween: 15,
        },

        1199: {
            allowTouchMove: false,
            loop: false,
            slidesPerView: false,
            pagination: false,
            navigation: false,
        },

    }
});

// One project
var swiperApartment = new Swiper(".swiper-apartments", {
    spaceBetween: 5,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,
});

new Swiper(".swiper-apartments-small", {
    spaceBetween: 16,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiperApartment,
    },
});
