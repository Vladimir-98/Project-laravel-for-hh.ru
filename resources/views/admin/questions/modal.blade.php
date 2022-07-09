<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">

            @if(!$delete)
                <form id="adminForm"
                      action="@isset($question){{ url('admin/questions/update') }}@else{{ url('admin/questions/create') }}@endisset"
                      method="POST">
                    @isset($question)
                        <input type="hidden" name="id" value="{{ $question->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    <div class="form-group" style="position: relative">
                        <label for="title_en">
                            {{ __('Заголовок вопроса EN') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_en" id="title_en" type="text"
                               @isset($question)value="{{ $question->title_en }}"@endisset>
                    </div>
                    <!=======Описание EN========>
                    <div class="form-group" style="position: relative">
                        <label for="description_en">
                            {{ __('Описание EN') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="textEdit">@isset($question){!! $question->description_en !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_en" id="description_en" type="text" style="display: none">
                            @isset($question){{ $question->description_en }}@endisset
                        </textarea>
                    </div>

                    <hr class="mt-4 mb-4">

                    <div class="form-group" style="position: relative">
                        <label for="title_tr">
                            {{ __('Заголовок вопроса TR') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_tr" id="title_tr" type="text"
                               @isset($question)value="{{ $question->title_tr }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="description_tr">
                            {{ __('Описание TR') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="textEdit">@isset($question){!! $question->description_tr !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_tr" id="description_tr" type="text" style="display: none">
                            @isset($question){{ $question->description_tr }}@endisset
                        </textarea>
                    </div>

                    <hr class="mt-4 mb-4">

                    <div class="form-group" style="position: relative">
                        <label for="title_ru">
                            {{ __('Заголовок вопроса RU') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_ru" id="title_ru" type="text"
                               @isset($question)value="{{ $question->title_ru }}"@endisset>
                    </div>

                    <div class="form-group" style="position: relative">
                        <label for="description_ru">
                            {{ __('Описание RU') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="textEdit">@isset($question){!! $question->description_ru !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_ru" id="description_ru" type="text" style="display: none">
                            @isset($question){{ $question->description_ru }}@endisset
                        </textarea>
                    </div>
{{--                    <div class="form-group" style="position: relative">--}}
{{--                        <label for="description_en">--}}
{{--                            {{ __('Описание EN') }}--}}
{{--                            <span class="required">*</span>--}}
{{--                        </label>--}}
{{--                        <textarea class="custom_input" name="description_en" id="description_en" type="text">--}}
{{--                            @isset($question){{ $question->description_en }}@endisset--}}
{{--                        </textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group" style="position: relative">--}}
{{--                        <label for="description_tr">--}}
{{--                            {{ __('Описание TR') }}--}}
{{--                            <span class="required">*</span>--}}
{{--                        </label>--}}
{{--                        <textarea class="custom_input" name="description_tr" id="description_tr" type="text">--}}
{{--                            @isset($question){{ $question->description_tr }}@endisset--}}
{{--                        </textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group" style="position: relative">--}}
{{--                        <label for="description_ru">--}}
{{--                            {{ __('Описание RU') }}--}}
{{--                            <span class="required">*</span>--}}
{{--                        </label>--}}
{{--                        <textarea class="custom_input" name="description_ru" id="description_ru" type="text">--}}
{{--                            @isset($question){{ $question->description_ru }}@endisset--}}
{{--                        </textarea>--}}
{{--                    </div>--}}
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
                <form id="adminForm" action="{{ url('admin/questions/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $question->id }}">
                    <input class="custom_input" name="title_ru" id="title_ru" type="hidden"
                           value="{{ $question->title_ru }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $question->title_ru }}{{ __('?') }}</h3>
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
