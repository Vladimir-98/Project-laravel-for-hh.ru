<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    @if($page->id == 6)
        <h5 class="mt-2">{{ __('pедактирование страницы рассрочка') }}</h5>
    @elseif($page->id == 9)
        <h5 class="mt-2">{{ __('pедактирование описания страницы дизайн') }}</h5>
    @else
        <h5 class="mt-2">{{ __('pедактирование o нас') }}</h5>
    @endif

</div>
<!====== ABOUT =======>
<div class="card-form ">
    <input type="hidden" name="about" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="about" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/about-update') }}"
          method="POST">
        <input type="hidden" name="about_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="about_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <!======= ABOUT EN ========>
        <div class="form-group" style="position: relative">
            <label for="title_about_en" style="color: #1a202c">
                {{ __('Заголовок EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_about_en" id="title_about_en" type="text"
                   @isset($page->about)value="{{ $page->about->title_about_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_about_en">
                {{ __('Описание EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                    <div class="form-group-img">
                        <label for="about_img">
                            {{ __('Изображение о нас (min 410 x 251)') }}
                            <span class="required" style="color: darkred">*</span>
                        </label>
                        <div class="img-box about_img about-img" style="background:
                        @if(!empty($page->about))
                            url(/upload/pages/about/{{ $page->about->about_img }})
                        @else
                            url(/upload/default_project_catalog.jpg)
                        @endif
                            no-repeat center/cover">
                            <input class="input-img" type="file" id="about_img" name="about_img" data-id="about_img"
                                   contenteditable="false" onchange="loadImageInput(event, this)">
                        </div>
                    </div>
                    <div class="form-group mt-1 mb-0" contenteditable="false" style="width: 100%">
                        <input class="custom_input input_alt" type="text" name="about_img_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->about){!! $page->about->about_img_alt !!}@endisset"
                               placeholder="описание изображения *">
                    </div>
                </div>
                <div
                    class="textEdit">@isset($page->about){!! $page->about->description_about_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_about_en" id="description_about_en" type="text"
                      style="display: none">
                                        @isset($page->about){{ $page->about->description_about_en }}@endisset
                                    </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <!======= ABOUT TR ========>

        <div class="form-group" style="position: relative">
            <label for="title_about_tr" style="color: #1a202c">
                {{ __('Заголовок TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_about_tr" id="title_about_tr" type="text"
                   @isset($page->about)value="{{ $page->about->title_about_tr }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="description_about_tr">
                {{ __('Описание TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                    <div class="form-group-img">
                        <label for="about_img">
                            {{ __('Изображение о нас (min 410 x 251)') }}
                            <span class="required" style="color: darkred">*</span>
                        </label>
                        <div class="img-box about_img about-img" style="background:
                        @if(!empty($page->about))
                            url(/upload/pages/about/{{ $page->about->about_img }})
                        @else
                            url(/upload/default_project_catalog.jpg)
                        @endif
                            no-repeat center/cover">
                            {{--                            <input class="input-img" type="file" contenteditable="false" >--}}
                        </div>
                    </div>
                </div>
                <div
                    class="textEdit">@isset($page->about){!! $page->about->description_about_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_about_tr" id="description_about_tr" type="text"
                      style="display: none">
                @isset($page->about){{ $page->about->description_about_tr }}@endisset
            </textarea>
        </div>

        <!======= ABOUT RU ========>
        <div class="form-group" style="position: relative">
            <label for="title_about_ru" style="color: #1a202c">
                {{ __('Заголовок RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_about_ru" id="title_about_ru" type="text"
                   @isset($page->about)value="{{ $page->about->title_about_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_about_ru">
                {{ __('Описание RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                    <div class="form-group-img">
                        <label for="about_img">
                            {{ __('Изображение о нас (min 410 x 251)') }}
                            <span class="required" style="color: darkred">*</span>
                        </label>
                        <div class="img-box about_img about-img" style="background:
                        @if(!empty($page->about))
                            url(/upload/pages/about/{{ $page->about->about_img }})
                        @else
                            url(/upload/default_project_catalog.jpg)
                        @endif
                            no-repeat center/cover">
                            {{--                            <input class="input-img" type="file" contenteditable="false" >--}}
                        </div>
                    </div>
                </div>
                <div
                    class="textEdit">@isset($page->about){!! $page->about->description_about_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_about_ru" id="description_about_ru" type="text"
                      style="display: none">
                @isset($page->about){{ $page->about->description_about_ru }}@endisset
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
