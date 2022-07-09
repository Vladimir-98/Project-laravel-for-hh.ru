
<!====== DESIGN =======>
<div class="header-block ml-3">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">{{ __('pедактирование блока дизайн') }}</h5>
</div>
<input type="hidden" name="design" id="pageComponent">
<input type="hidden" value="{{ $page->id }}" name="design" id="currentPage">
<div class="card-form blue-container p-0 ml-0 mr-0" style="background: transparent">
    <form id="adminForm" action="{{ url('admin/pages/show/design-update') }}" method="POST">
        <input type="hidden" name="design_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="design_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <!===== DESIGN CONTENT =====>
        <h6 class="m-5">{{ __('Заголовок блока') }}</h6>
        <div class="form-group" style="position: relative">
            <label for="title_design_en" style="color: #1a202c">
                {{ __('Заголовок EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_design_en" id="title_design_en" type="text"
                   @isset($page->design)value="{{ $page->design->title_design_en }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="title_design_tr" style="color: #1a202c">
                {{ __('Заголовок TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_design_tr" id="title_design_tr" type="text"
                   @isset($page->design)value="{{ $page->design->title_design_tr }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="title_design_ru" style="color: #1a202c">
                {{ __('Заголовок RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_design_ru" id="title_design_ru" type="text"
                   @isset($page->design)value="{{ $page->design->title_design_ru }}"@endisset>
        </div>

        <hr class="mt-4 mb-4">

        <h6 class="m-5">{{ __('Изображения') }}</h6>
        <div class="card-grid-trio admin_design_trio">

            <!============= DESIGN IMG ==============>

            <div class="box-form-group-img img_1 mb-0">
                <div class="form-group-img">
                    <label for="design_img_one" class="text-center">
                        {{ __('Изображение (min 352 x 436)') }}
                        <span class="required" style="color: darkred">*</span>
                    </label>
                    <div class="img-box mt-3 mb-3" style="max-width: 253px; height: 313px; background:
                    @if(!empty($page->design))
                        url(/upload/pages/design/{{ $page->design->design_img_one }})
                    @else
                        url(/upload/default_project_catalog.jpg)
                    @endif
                        no-repeat center/cover">
                        <input class="input-img" type="file" name="design_img_one" onchange="loadImageInput(event, this)">
                    </div>
                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="design_img_one_alt">
                            {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="design_img_one_alt" type="text" name="design_img_one_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->design){{ $page->design->design_img_one_alt }}@endisset">
                    </div>
                </div>
            </div>

            <!============= TWO ==============>

            <div class="box-form-group-img img_2 mb-0">
                <div class="form-group-img">
                    <label for="design_img_two" class="text-center">
                        {{ __('Изображение (min 372 x 219)') }}
                        <span class="required" style="color: darkred">*</span>
                    </label>
                    <div class="img-box mt-3 mb-3" style="max-width: 275px; height: 157px; background:
                    @if(!empty($page->design))
                        url(/upload/pages/design/{{ $page->design->design_img_two }})
                    @else
                        url(/upload/default_project_catalog.jpg)
                    @endif
                        no-repeat center/cover">
                        <input class="input-img" type="file" name="design_img_two" onchange="loadImageInput(event, this)">
                    </div>
                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="design_img_two_alt">
                            {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="design_img_two_alt" type="text" name="design_img_two_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->design){{ $page->design->design_img_two_alt }}@endisset">
                    </div>
                </div>
            </div>
            <!============= THREE ==============>

            <div class="box-form-group-img img_3 mb-0">
                <div class="form-group-img">
                    <label for="design_img_three" class="text-center">
                        {{ __('Изображение (min 313 x 205)') }}
                        <span class="required" style="color: darkred">*</span>
                    </label>
                    <div class="img-box mt-3 mb-3" style="max-width: 225px; height: 148px; background:
                    @if(!empty($page->design))
                        url(/upload/pages/design/{{ $page->design->design_img_three }})
                    @else
                        url(/upload/default_project_catalog.jpg)
                    @endif
                        no-repeat center/cover">
                        <input class="input-img" type="file" name="design_img_three" onchange="loadImageInput(event, this)">
                    </div>
                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="design_img_three_alt">
                            {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="design_img_three_alt" type="text" name="design_img_three_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->design){{ $page->design->design_img_three_alt }}@endisset">
                    </div>
                </div>
            </div>


            <!============= FOUR ==============>

            <div class="box-form-group-img img_4 mb-0">
                <div class="form-group-img">
                    <label for="design_img_four" class="text-center">
                        {{ __('Изображение (min 333 x 216)') }}
                        <span class="required" style="color: darkred">*</span>
                    </label>
                    <div class="img-box mt-3 mb-3" style="max-width: 239px; height: 155px; background:
                    @if(!empty($page->design))
                        url(/upload/pages/design/{{ $page->design->design_img_four }})
                    @else
                        url(/upload/default_project_catalog.jpg)
                    @endif
                        no-repeat center/cover">
                        <input class="input-img" type="file" name="design_img_four" onchange="loadImageInput(event, this)">
                    </div>
                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="design_img_four_alt">
                            {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="design_img_four_alt" type="text" name="design_img_four_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->design){{ $page->design->design_img_four_alt }}@endisset">
                    </div>
                </div>
            </div>

            <!============= FIVE ==============>

            <div class="box-form-group-img img_5 mb-0">
                <div class="form-group-img">
                    <label for="design_img_five" class="text-center">
                        {{ __('Изображение (min 254 x 315)') }}
                        <span class="required" style="color: darkred">*</span>
                    </label>
                    <div class="img-box mt-3 mb-3" style="max-width: 182px; height: 226px; background:
                    @if(!empty($page->design))
                        url(/upload/pages/design/{{ $page->design->design_img_five }})
                    @else
                        url(/upload/default_project_catalog.jpg)
                    @endif
                        no-repeat center/cover">
                        <input class="input-img" type="file" name="design_img_five" onchange="loadImageInput(event, this)">
                    </div>
                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="design_img_five_alt">
                            {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="design_img_five_alt" type="text" name="design_img_five_alt"
                               style="height: 25px; font-size: 12px;"
                               value="@isset($page->design){{ $page->design->design_img_five_alt }}@endisset">
                    </div>
                </div>
            </div>
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
