<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">

            @if(!$delete)
                <form id="adminForm" action="@isset($city){{ url('admin/cities/update') }}@else{{ url('admin/cities/create') }}@endisset" method="POST">
                    @isset($city)
                        <input type="hidden" name="id" value="{{ $city->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    <div class="form-group" style="position: relative">
                        <label for="name_en">
                            {{ __('Название города EN') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_en" id="name_en" type="text" @isset($city)value="{{ $city->name_en }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_tr">
                            {{ __('Название города TR') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_tr" id="name_tr" type="text" @isset($city)value="{{ $city->name_tr }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_ru">
                            {{ __('Название города RU') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_ru" id="name_ru" type="text" @isset($city)value="{{ $city->name_ru }}"@endisset>
                    </div>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button data-name="city" type="button" class="btn btn-blue form_btn">
                                {{ __('сохранить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <form id="adminForm" action="{{ url('admin/cities/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $city->id }}">
                    <input class="custom_input" name="name_en" id="name_en" type="hidden" value="{{ $city->name_ru }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $city->name_en }}{{ __('?') }}</h3>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button type="button" class="btn btn-danger form_btn">
                                {{ __('удалить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<script>


    // function onsubmitForm(form) {
    //     let formData = new FormData(form);
    //     let ajax = new XMLHttpRequest();
    //     ajax.open('POST', form.getAttribute('action'), true)
    //     ajax.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector("[name=csrf-token]").content);
    //     ajax.onload = () => {
    //         if (ajax.readyState === 4 && ajax.status === 200) {
    //             let data = JSON.parse(ajax.responseText);
    //             if (data['success']) {
    //                 getAlert('success', data['success']);
    //                 setTimeout(() => {
    //                     // closeModal();
    //                     fetchData('1', 'desc')
    //                 }, 500);
    //
    //             } else {
    //                 getAlert('danger', data);
    //             }
    //         }
    //         if (this.status === 500) {
    //             getAlert('danger', 'Что-то пошло не так(((');
    //         }
    //     }
    //
    //     ajax.send(formData);
    //
    //     return false;
    //
    // }
</script>
