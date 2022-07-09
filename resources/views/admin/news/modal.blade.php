<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form map">
            @if(!$delete)
                <form id="adminForm"
                      action="@isset($news){{ url('admin/news/update') }}@else{{ url('admin/news/create') }}@endisset"
                      method="POST">
                    @isset($news)
                        <input type="hidden" name="id" value="{{ $news->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset

                    <div class="form-group" style="position: relative">
                        <label for="title_en">
                            {{ __('Заголовок новости EN') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_en" id="title_en" type="text"
                               @isset($news)value="{{ $news->title_en }}"@endisset>
                    </div>
                    <!=======Описание EN========>
                    <div class="form-group" style="position: relative">
                        <label for="description_en">
                            {{ __('Описание EN') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="box-form-group-img admin-box-img mb-0" contenteditable="false" style="float: right; margin-left: 32px; margin-top: calc(10px - 20px);">
                                <div class="form-group-img">
                                    <label for="img" contenteditable="false">
                                        {{ __('Изображение (min 240 x 160)') }}
                                        <span class="required" style="color: darkred">*</span>
                                    </label>
                                    <div class="img-box post" style="width: 240px; height: 160px; background:
                                    @if($news)
                                        url(/upload/news/{{ $news->images->post }})
                                    @else
                                        url(/upload/default_project_catalog.jpg)
                                    @endif
                                        no-repeat center/cover">
                                        <input class="input-img" type="file" name="post" data-id="post" contenteditable="false" onchange="loadImageInput(event, this)">
                                    </div>
                                    <div class="form-group mt-1 mb-0" contenteditable="false">
                                        <input class="custom_input post_alt input_alt" type="text" name="post_alt"
                                               style="height: 25px; font-size: 12px;"
                                               value="@isset($news){{ $news->images->post_alt }}@endisset"
                                               placeholder="{{ __('описание изображения *') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="textEdit">@isset($news){!! $news->description_en !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_en" id="description_en" type="text" style="display: none">
                            @isset($news){{ $news->description_en }}@endisset
                        </textarea>
                    </div>

                    <hr class="mt-4 mb-4">

                    <div class="form-group" style="position: relative">
                        <label for="title_tr">
                            {{ __('Заголовок новости TR') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_tr" id="title_tr" type="text"
                               @isset($news)value="{{ $news->title_tr }}"@endisset>
                    </div>
                    <!=======Описание TR========>
                    <div class="form-group" style="position: relative">
                        <label for="description_tr">
                            {{ __('Описание TR') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="box-form-group-img admin-box-img mt-2" contenteditable="false" style="float: right; margin-left: 32px;">
                                <div class="form-group-img">
                                    <div class="img-box post" style="width: 240px; height: 160px; background:
                                    @if($news)
                                        url(/upload/news/{{ $news->images->post }})
                                    @else
                                        url(/upload/default_project_catalog.jpg)
                                    @endif
                                        no-repeat center/cover">
{{--                                        <input class="input-img" type="file" contenteditable="false">--}}
                                    </div>
                                </div>
                            </div>
                            <div class="textEdit">@isset($news){!! $news->description_tr !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_tr" id="description_tr" type="text" style="display: none">
                            @isset($news){{ $news->description_tr }}@endisset
                        </textarea>
                    </div>

                    <hr class="mt-4 mb-4">

                    <div class="form-group" style="position: relative">
                        <label for="title_ru">
                            {{ __('Заголовок новости RU') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="title_ru" id="title_ru" type="text"
                               @isset($news)value="{{ $news->title_ru }}"@endisset>
                    </div>
                    <!=======Описание RU========>
                    <div class="form-group" style="position: relative">
                        <label for="description_ru">
                            {{ __('Описание RU') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="box-form-group-img admin-box-img mt-2" contenteditable="false" style="float: right; margin-left: 32px;">
                                <div class="form-group-img">
                                    <div class="img-box post" style="width: 240px; height: 160px; background:
                                    @if($news)
                                        url(/upload/news/{{ $news->images->post }})
                                    @else
                                        url(/upload/default_project_catalog.jpg)
                                    @endif
                                        no-repeat center/cover">
{{--                                        <input class="input-img" type="file" contenteditable="false">--}}
                                    </div>
                                </div>
                            </div>
                            <div class="textEdit">@isset($news){!! $news->description_ru !!}@else{{ __('Описание...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="description_ru" id="description_ru" type="text" style="display: none">
                        @isset($news){{ $news->description_ru }}@endisset
                    </textarea>
                    </div>

                    <div class="form-group" style="position: relative">
                        <label for="youtube">
                            {{ __('Ссылка для встраивания с ютуб') }}
                        </label>
                        <input class="custom_input" name="youtube" id="youtube" type="text"
                               @isset($news)value="{{ $news->images->youtube }}" @endisset
                               placeholder="{{ __('Вставить <iframe>...</iframe>') }}">
                    </div>
                        @if (!empty($news->images->youtube))
                            <iframe src="{{ $news->images->youtube }}" style="border:0;"></iframe>
                        @endif
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
                <form id="adminForm" action="{{ url('admin/news/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $news->id }}">
                    <input class="custom_input" name="title_ru" id="title_ru" type="hidden"
                           value="{{ $news->title_ru }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $news->title_ru }}{{ __('?') }}</h3>
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
