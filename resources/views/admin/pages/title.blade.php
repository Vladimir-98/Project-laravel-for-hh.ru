<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">
        @if($page->id === 1)
            {{ __('редактирование заголовков страницы') }}
        @else
            {{ __('редактирование заголовка страницы') }}
        @endif
    </h5>
</div>

<div class="card-form">
    <input type="hidden" name="page-title" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="page-title" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/page-title-update') }}"
          method="POST">
        <input type="hidden" name="page_title_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="page_title_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <h6 class="m-5">
            @if($page->id === 1)
                {{ __('Заголовок реализованных проектов') }}
            @endif
        </h6>

        <div class="form-group" style="position: relative">
            <label for="page_title_one_en" style="color: #1a202c">
                {{ __('Заголовок EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="page_title_one_en" id="page_title_one_en" type="text"
                   @isset($page->title)value="{{ $page->title->page_title_one_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="page_title_one_tr" style="color: #1a202c">
                {{ __('Заголовок TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="page_title_one_tr" id="page_title_one_tr" type="text"
                   @isset($page->title)value="{{ $page->title->page_title_one_tr }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="page_title_one_ru" style="color: #1a202c">
                {{ __('Заголовок RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="page_title_one_ru" id="page_title_one_ru" type="text"
                   @isset($page->title)value="{{ $page->title->page_title_one_ru }}"@endisset>
        </div>

        @if($page->id === 1)
            <hr class="mt-4 mb-4">


            <h6 class="m-5">{{ __('Заголовок строящихся проектов') }}</h6>

            <div class="form-group" style="position: relative">
                <label for="page_title_two_en" style="color: #1a202c">
                    {{ __('Заголовок EN') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_two_en" id="page_title_two_en" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_two_en }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_two_tr" style="color: #1a202c">
                    {{ __('Заголовок TR') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_two_tr" id="page_title_two_tr" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_two_tr }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_two_ru" style="color: #1a202c">
                    {{ __('Заголовок RU') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_two_ru" id="page_title_two_ru" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_two_ru }}"@endisset>
            </div>


            <hr class="mt-4 mb-4">


            <h6 class="m-5">{{ __('Заголовок квартир') }}</h6>

            <div class="form-group" style="position: relative">
                <label for="page_title_three_en" style="color: #1a202c">
                    {{ __('Заголовок EN') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_three_en" id="page_title_three_en" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_three_en }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_three_tr" style="color: #1a202c">
                    {{ __('Заголовок TR') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_three_tr" id="page_title_three_tr" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_three_tr }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_three_ru" style="color: #1a202c">
                    {{ __('Заголовок RU') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_three_ru" id="page_title_three_ru" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_three_ru }}"@endisset>
            </div>


            <hr class="mt-4 mb-4">


            <h6 class="m-5">{{ __('Заголовок вопросов') }}</h6>

            <div class="form-group" style="position: relative">
                <label for="page_title_four_en" style="color: #1a202c">
                    {{ __('Заголовок EN') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_four_en" id="page_title_four_en" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_four_en }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_four_tr" style="color: #1a202c">
                    {{ __('Заголовок TR') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_four_tr" id="page_title_four_tr" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_four_tr }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="page_title_four_ru" style="color: #1a202c">
                    {{ __('Заголовок RU') }}
                    <span class="required">*</span>
                </label>
                <input class="custom_input" name="page_title_four_ru" id="page_title_four_ru" type="text"
                       @isset($page->title)value="{{ $page->title->page_title_four_ru }}"@endisset>
            </div>
        @endif
        <!====== FOOTER BUTTON ======>
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
</div>
