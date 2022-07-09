
<!====== HEADER =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">{{ __('pедактирование шапки') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="header" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="header" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/header-update') }}"
          method="POST">
        <input type="hidden" name="header_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="header_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')
        <!====== HEADER IMG ======>
        <div class="box-form-group-img">
            <div class="form-group-img">
                <label for="header_img" class="text-left">
                    {{ __('Изображение шапки страницы (min 1280 x 450)') }}
                    <span class="required" style="color: darkred">*</span>
                </label>
                <div class="img-box mt-3 mb-3" style="max-width: 850px; height: 322px; background:
                @if(!empty($page->header))
                    url(/upload/pages/header/{{ $page->header->header_img }})
                @else
                    url(/upload/default_project_catalog.jpg)
                @endif
                    no-repeat center/cover">
                    <input class="input-img" type="file" name="header_img" onchange="loadImageInput(event, this)">
                </div>
                <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                    <label for="header_img_alt">
                        {{ __('описание изображения') }}
                        <span class="required">*</span>
                    </label>
                    <input class="custom_input input_alt" id="header_img_alt" type="text" name="header_img_alt"
                           style="height: 25px; font-size: 12px;"
                           value="@isset($page->header){{ $page->header->header_img_alt }}@endisset">
                </div>
            </div>
        </div>

        <!===== HEADER CONTENT =====>
        <h5 class="m-5">{{ __('Заголовок и описание шапки') }}</h5>
        <div class="form-group" style="position: relative">
            <label for="title_header_en" style="color: #1a202c">
                {{ __('Заголовок шапки EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_header_en" id="title_header_en" type="text"
                   @isset($page->header)value="{{ $page->header->title_header_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_header_en">
                {{ __('Описание шапки EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true"
                 onblur="addDataTextarea(this)" style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->header){!! $page->header->description_header_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_header_en" id="description_header_en" type="text"
                      style="display: none">
                                            @isset($page->header){{ $page->header->description_header_en }}@endisset
                                        </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <div class="form-group" style="position: relative">
            <label for="title_header_tr" style="color: #1a202c">
                {{ __('Заголовок шапки TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_header_tr" id="title_header_tr" type="text"
                   @isset($page->header)value="{{ $page->header->title_header_tr }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_header_tr">
                {{ __('Описание шапки TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->header){!! $page->header->description_header_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_header_tr" id="description_header_tr" type="text"
                      style="display: none">
                                        @isset($page->header){{ $page->header->description_header_tr }}@endisset
                                    </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <div class="form-group" style="position: relative">
            <label for="title_header_ru" style="color: #1a202c">
                {{ __('Заголовок шапки RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_header_ru" id="title_header_ru" type="text"
                   @isset($page->header)value="{{ $page->header->title_header_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_ru">
                {{ __('Описание шапки RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->header){!! $page->header->description_header_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_header_ru" id="description_header_ru" type="text"
                  style="display: none">
                                    @isset($page->header){{ $page->header->description_header_ru }}@endisset
                                </textarea>
        </div>
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                <button data-name="city" type="button" class="btn btn-blue form_btn">
                    {{ __('сохранить') }}
                </button>
            </div>
        </div>
    </form>
</div>
