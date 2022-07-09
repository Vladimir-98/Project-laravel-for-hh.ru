<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ __('Квартира ') }}{{ $apartment->layout }}{{ __('+1 - ') }}  {{ $apartment->city->name_ru }}{{__(' (')}}{{ $apartment->district->name_ru }}{{__(')')}}</h3>
    <h5 class="mt-2">{{ __('pедактирование o описания') }}</h5>
</div>
<!====== HEADER =======>
<div class="card-form ">
    <input type="hidden" name="description" id="pageComponent">
    <form id="adminForm"
          action="{{ url('admin/apartments/show/description-update') }}"
          method="POST">
        <input type="hidden" name="description_gable_id" value="{{ $apartment->id }}">
        <input type="hidden" name="description_gable_type" value="{{ __('App\Models\Admin\Apartments') }}">
        <input type="hidden" value="{{ $apartment->id }}" name="description" id="currentPage">
        <input type="hidden" value="{{ $apartment->id }}" name="apartment_id">
        <input type="hidden" id="currentSortId">
        @method('PUT')

        <!======= DESCRIPTION EN ========>
        <div class="form-group" style="position: relative">
            <label for="title_en" style="color: #1a202c">
                {{ __('Заголовок описания EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_en" id="title_en" type="text"
                   @isset($apartment->DESCRIPTION)value="{{ $apartment->DESCRIPTION->title_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_en">
                {{ __('Описание EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($apartment->description){!! $apartment->description->description_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_en" id="description_en" type="text"
                      style="display: none">
                @isset($apartment->description){{ $apartment->description->description_en }}@endisset
            </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <!======= DESCRIPTION TR ========>

        <div class="form-group" style="position: relative">
            <label for="title_tr" style="color: #1a202c">
                {{ __('Заголовок описания TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_tr" id="title_tr" type="text"
                   @isset($apartment->description)value="{{ $apartment->description->title_tr }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="description_tr">
                {{ __('Описание TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($apartment->description){!! $apartment->description->description_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_tr" id="description_tr" type="text"
                      style="display: none">
                @isset($apartment->description){{ $apartment->description->description_tr }}@endisset
            </textarea>
        </div>

        <!======= DESCRIPTION RU ========>
        <div class="form-group" style="position: relative">
            <label for="title_ru" style="color: #1a202c">
                {{ __('Заголовок описания RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_ru" id="title_ru" type="text"
                   @isset($apartment->description)value="{{ $apartment->description->title_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_ru">
                {{ __('Описание RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($apartment->description){!! $apartment->description->description_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_ru" id="description_ru" type="text"
                      style="display: none">
                @isset($apartment->description){{ $apartment->description->description_ru }}@endisset
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
