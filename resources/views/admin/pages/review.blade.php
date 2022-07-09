<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    @if($page->id == 1)
        <h5 class="mt-2">{{ __('pедактирование информации отзывов') }}</h5>
    @elseif($page->id == 8)
        <h5 class="mt-2">{{ __('pедактирование соглашения') }}</h5>
    @elseif($page->id == 9)
        <h5 class="mt-2">{{ __('pедактирование описания') }}</h5>
    @endif
</div>
<!====== REVIEW && DESCRIPTION =======>
<div class="card-form ">
    <input type="hidden" name="review" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="review" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/review-update') }}"
          method="POST">
        <input type="hidden" name="review_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="review_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <!======= REVIEW && DESCRIPTION EN ========>
        <div class="form-group" style="position: relative">
            <label for="title_review_en" style="color: #1a202c">
                {{ __('Заголовок EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_review_en" id="title_review_en" type="text"
                   @isset($page->reviews)value="{{ $page->reviews->title_review_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_review_en">
                {{ __('Описание EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 400px">
                <div class="textEdit">@isset($page->reviews){!! $page->reviews->description_review_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_review_en" id="description_review_en" type="text" style="display: none">
                @isset($page->reviews){{ $page->reviews->description_review_en }}@endisset
            </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <!======= REVIEW && DESCRIPTION TR ========>

        <div class="form-group" style="position: relative">
            <label for="title_review_tr" style="color: #1a202c">
                {{ __('Заголовок TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_review_tr" id="title_review_tr" type="text"
                   @isset($page->reviews)value="{{ $page->reviews->title_review_tr }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="description_review_tr">
                {{ __('Описание TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 400px">
                <div class="textEdit">@isset($page->reviews){!! $page->reviews->description_review_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_review_tr" id="description_review_tr" type="text" style="display: none">
                @isset($page->reviews){{ $page->reviews->description_review_tr }}@endisset
            </textarea>
        </div>

        <!======= REVIEW && DESCRIPTION RU ========>
        <div class="form-group" style="position: relative">
            <label for="title_review_ru" style="color: #1a202c">
                {{ __('Заголовок RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_review_ru" id="title_review_ru" type="text"
                   @isset($page->reviews)value="{{ $page->reviews->title_review_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_review_ru">
                {{ __('Описание RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 400px">
                <div class="textEdit">@isset($page->reviews){!! $page->reviews->description_review_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_review_ru" id="description_review_ru" type="text" style="display: none">
                @isset($page->reviews){{ $page->reviews->description_review_ru }}@endisset
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
