
<!====== META =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    @if($page->id == 6)
        <h5 class="mt-2">{{ __('pедактирование метатегов страницы рассрочка') }}</h5>
    @else
        <h5 class="mt-2">
            {{ __('редактирование метатегов') }}
        </h5>
    @endif

</div>
<div class="card-form">
    <input type="hidden" name="meta" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="meta" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/meta-update') }}"
          method="POST">
        <input type="hidden" name="meta_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="meta_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <div class="form-group" style="position: relative">
            <label for="title_meta_en" style="color: #1a202c">
                {{ __('Заголовок мета тегов EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_meta_en" id="title_meta_en" type="text"
                   @isset($page->meta)value="{{ $page->meta->title_meta_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_meta_en">
                {{ __('Описание мета тегов EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true"
                 onblur="addDataTextarea(this)" style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->meta){!! $page->meta->description_meta_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_meta_en" id="description_meta_en" type="text" style="display: none">
                @isset($page->meta){{ $page->meta->description_meta_en }}@endisset
            </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <div class="form-group" style="position: relative">
            <label for="title_meta_tr" style="color: #1a202c">
                {{ __('Заголовок мета тегов TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_meta_tr" id="title_meta_tr" type="text"
                   @isset($page->meta)value="{{ $page->meta->title_meta_tr }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_meta_tr">
                {{ __('Описание мета тегов TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->meta){!! $page->meta->description_meta_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_meta_tr" id="description_meta_tr" type="text"
                      style="display: none">
                                        @isset($page->meta){{ $page->meta->description_meta_tr }}@endisset
                                    </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <div class="form-group" style="position: relative">
            <label for="title_meta_ru" style="color: #1a202c">
                {{ __('Заголовок мета тегов RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_meta_ru" id="title_meta_ru" type="text"
                   @isset($page->meta)value="{{ $page->meta->title_meta_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_meta_ru">
                {{ __('Описание мета тегов RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 150px">
                <div
                    class="textEdit">@isset($page->meta){!! $page->meta->description_meta_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_meta_ru" id="description_meta_ru" type="text"
                  style="display: none">
                                    @isset($page->meta){{ $page->meta->description_meta_ru }}@endisset
                                </textarea>
        </div>

{{--        <hr class="mt-4 mb-4">--}}

{{--        <div class="form-group" style="position: relative">--}}
{{--            <label for="canonical" style="color: #1a202c">--}}
{{--                {{ __('Каноническое название.') }}--}}
{{--                <span class="required">{{ __('Важно!!! Для каждой страницы, своё название пример: "http://sultan_2699.com/project/1..."') }}</span>--}}
{{--            </label>--}}
{{--            <input class="custom_input" name="canonical" id="canonical" type="text"--}}
{{--                   @isset($page->meta)value="{{ $page->meta->canonical }}"@endisset>--}}
{{--        </div>--}}
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
