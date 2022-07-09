const boxFilter = document.querySelector('#boxFilter');
const boxCatalog = document.querySelector('#catalogData')

boxFilter.addEventListener('click', function (e) {

    let elem = e.target;
    // Checked
    if (elem.closest('.one-checked')) {                                             // One checked
        let checkBox = elem.closest('.nav-link-dropdown');
        let inputs = checkBox.querySelectorAll('input');

        inputs.forEach(input => {
            input.classList.remove('checked');
        });

        elem.classList.add('checked');

        if (elem.getAttribute('name') === 'city_id') {

            if (addDataDistricts(elem.value)) {
                addFilter();
            }
        } else {
            addFilter();
        }

    } else if (elem.closest('.several-checked')) {                                                      // Some checked
        elem.classList.contains('checked') ? elem.classList.remove('checked') : elem.classList.add('checked');

        addFilter();

    } else if (elem.closest('.click_number_filter')) {                                              // Filter input number
        let sum = document.querySelector('#' + elem.getAttribute('data-id') + '');
        let index = sum.value;
        if (elem.innerHTML === '-') {
            index--;
        } else {
            index++;
        }
        if (index < 0) {
            sum.value = '';
            return
        }
        sum.value = index;
        addFilter();
    }
})

// Sort by
boxCatalog.addEventListener('click', function (e) {
    let elem = e.target;

    if (elem.closest('.sort_by')) {
        // let input = document.querySelector('#priceFilter');
        let input = document.querySelector('#' + elem.getAttribute('data-name') + '');

        if (input.value === 'desc') {
            input.value = 'asc'
        } else {
            input.value = 'desc'
        }
        setTimeout('addFilter()', 200);
    }
})


// Filter input number (Paste)
boxFilter.addEventListener('keydown', function (event) {
    let elem = event.target;
    let k = event.which;
    if (elem.closest('.custom_input')) {
        if ((k < 48 || k > 57) && (k < 96 || k > 105) && (k !== 8)) {
            event.preventDefault();
            return false;
        }
        setTimeout('addFilter()', 200);
    }
})

// Add Filter

function addFilter() {
    boxCatalog.animate([
        {opacity: '1'},
        {opacity: '0'}
    ], {
        duration: 300
    });

    let form = document.querySelector('#getFilterForm');
    let inputs = form.querySelectorAll('input')

    let getData = '';
    inputs.forEach(input => {
        if (input.classList.contains('checked') && (input.value != 0)) {
            getData += String(input.name + '=' + input.value + '&');
        }
    })
console.log(getData);
    let ajax = new XMLHttpRequest();
    ajax.open('GET', form.getAttribute('action') + '?' + getData, false);
    ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
    ajax.onload = () => {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                boxCatalog.innerHTML = ajax.responseText;
                // setTimeout(boxCatalog.style.display = 'none' , 300);
                boxCatalog.animate([
                    {opacity: '0'},
                    {opacity: '1'}
                ], {
                    duration: 300
                });
            }
        }
    }
    ajax.send();
}

// Get districts

function addDataDistricts(city_id) {
    let result = false;
    let ajax = new XMLHttpRequest();
    ajax.open('GET', 'add-filter-districts?city_id=' + city_id, false);
    ajax.onload = () => {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                if (ajax.responseText) {
                    boxFilter.querySelector('#filterDistrict').style.display = 'block';
                } else {
                    boxFilter.querySelector('#filterDistrict').style.display = 'none';
                }
                boxFilter.querySelector('#filterDistrict').innerHTML = ajax.responseText;
                result = true;
            }
        }
    }
    ajax.send();
    return result;
}

// Paginate

boxCatalog.addEventListener('click', function (e) {
    let elem = e.target;
    if (elem.closest('.page-link')) {
        e.preventDefault();
        if (elem.hasAttribute('href')) {
            let url = elem.getAttribute('href');
            boxCatalog.animate([
                {opacity: '1'},
                {opacity: '0'}
            ], {
                duration: 300
            });
            fetchDataFilter(url);
            upPage();
        }
    }

}, false);

// Get data table

function fetchDataFilter(url) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.onload = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                boxCatalog.innerHTML = xhr.response;

                boxCatalog.animate([
                    {opacity: '0'},
                    {opacity: '1'}
                ], {
                    duration: 300
                });
            }
        }
    }
    xhr.send();
}

let t;

function upPage() {
    let top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
    if (top > 0) {
        window.scrollBy(0, -10);
        t = setTimeout('upPage()', 2);
    } else clearTimeout(t);
    return false;
}
