<!======    PROJECT SLIDER LAYOUTS =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">{{ __('редактирование планировки') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="layouts" id="pageComponent">
    <form id="adminForm"
          action="@if(count($project->layoutSlider)){{ url('admin/projects/update-layouts') }}@else{{ url('admin/projects/add-layouts') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if(count($project->layoutSlider))
            @method('PUT')
        @else
            @csrf
        @endif
        <input type="hidden" value="{{ $project->id }}" name="layouts-slider" id="currentPage">
        <input type="hidden" value="{{ $project->id }}" name="project_id">
        <input type="hidden" id="currentSortId">
            <input type="hidden" name="description_id" @isset($project->layoutDescription)value="{{ $project->layoutDescription->id }}"@endisset>
            <!======= DESCRIPTION EN ========>
            <div class="form-group" style="position: relative">
                <label for="title_en" style="color: #1a202c">
                    {{ __('Заголовок описания планировок EN') }}
                </label>
                <input class="custom_input" name="title_en" id="title_en" type="text"
                       @if(!empty($project->layoutDescription->title_en))value="{{ $project->layoutDescription->title_en }}"@endif>
            </div>
            <div class="form-group" style="position: relative">
                <label for="description_en">
                    {{ __('Описание планировок EN') }}
                </label>
                @include('layouts.admin.layouts.contenteditable')
                <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 150px">
                    <div class="textEdit">@if(!empty($project->layoutDescription->description_en)){!! $project->layoutDescription->description_en !!}@else{{ __('Описание...') }}@endif</div>
                </div>
                <textarea class="custom_input" name="description_en" id="description_en" type="text"
                          style="display: none">
                @if(!empty($project->layoutDescription->description_ru)){{ $project->layoutDescription->description_en }}@endif
            </textarea>
            </div>

            <hr class="mt-4 mb-4">

            <!======= DESCRIPTION TR ========>

            <div class="form-group" style="position: relative">
                <label for="title_tr" style="color: #1a202c">
                    {{ __('Заголовок описания планировок TR') }}
                </label>
                <input class="custom_input" name="title_tr" id="title_tr" type="text"
                       @if(!empty($project->layoutDescription->title_tr))value="{{ $project->layoutDescription->title_tr }}"@endif>
            </div>

            <div class="form-group" style="position: relative">
                <label for="description_tr">
                    {{ __('Описание планировок TR') }}
                </label>
                @include('layouts.admin.layouts.contenteditable')
                <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 150px">
                    <div class="textEdit">@if(!empty($project->layoutDescription->description_tr)){!! $project->layoutDescription->description_tr !!}@else{{ __('Описание...') }}@endif</div>
                </div>
                <textarea class="custom_input" name="description_tr" id="description_tr" type="text"
                          style="display: none">
                @if(!empty($project->layoutDescription->description_ru)){{ $project->layoutDescription->description_tr }}@endif
            </textarea>
            </div>

            <hr class="mt-4 mb-4">

            <!======= DESCRIPTION RU ========>
            <div class="form-group" style="position: relative">
                <label for="title_ru" style="color: #1a202c">
                    {{ __('Заголовок описания планировок RU') }}
                </label>
                <input class="custom_input" name="title_ru" id="title_ru" type="text"
                       @isset($project->layoutDescription)value="{{ $project->layoutDescription->title_ru }}"@endisset>
            </div>
            <div class="form-group" style="position: relative">
                <label for="description_ru">
                    {{ __('Описание планировок RU') }}
                </label>
                @include('layouts.admin.layouts.contenteditable')
                <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 150px">
                    <div class="textEdit">@if(!empty($project->layoutDescription->description_ru)){!! $project->layoutDescription->description_ru !!}@else{{ __('Описание...') }}@endif</div>
                </div>
                <textarea class="custom_input" name="description_ru" id="description_ru" type="text"
                          style="display: none">
                @isset($project->layoutDescription){{ $project->layoutDescription->description_ru }}@endisset
            </textarea>
            </div>


        <div class="box-form-group-img card-grid-trio project_slider-grid" style="gap: 0;">
            @if (count($project->layoutSlider))
                @for($i = 0; $i < count($project->layoutSlider); $i++)
                    <div class="add-block">
                        <h6 class="mt-5 text-center">{{ __('планировка №') }}{{ $i + 1 }}</h6>
                        <div class="row">
                            <div class="form-group-img pt-0 col-md-6">
                                <label for="image_{{ $i + 1 }}" class="d-flex">
                                    <div class="mx-auto">
                                        {{ $i + 1 }}{{ __(' - ') }}{{ __('(min 260 x 205)') }}
                                        <span class="required">*</span>
                                    </div>
                                    <div class="page-logo">
                                        <a href="javascript:void(0)" class="sort_by float-right">
                                            <i style="font-size: 17px" data-id="{{ $project->layoutSlider[$i]->id }}" class="delete-images fa fa-trash text-danger"
                                               aria-hidden="true"></i>
                                            <input type="hidden" name="projects/delete-layouts/" value="{{ $project->layoutSlider[$i]->id }}">
                                        </a>
                                    </div>
                                </label>
                                <div class="img-box mt-3 mb-3"
                                     style="width: 260px; height: 204px; background: url(/upload/projects/layouts/{{ $project->layoutSlider[$i]->image }})no-repeat center/cover">
                                    <input class="input-img" id="image_{{ $i + 1 }}" type="file" name="image_{{ $i + 1 }}" onchange="loadImageInput(event, this)">
                                </div>

                                <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                    <label for="image_alt_{{ $i + 1 }}"> {{ __('описание изображения') }} <span class="required">*</span></label>
                                    <input class="custom_input input_alt" id="image_alt_{{ $i + 1 }}" type="text"
                                           name="image_alt_{{ $i + 1 }}"
                                           style="height: 25px; font-size: 12px;"
                                           value="{{ $project->layoutSlider[$i]->image_alt }}">
                                    <input type="hidden" value="{{ $project->layoutSlider[$i]->id }}" name="id_{{ $i + 1 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-5">
                                <div class="form-group" style="position: relative">
                                    <label for="layout_{{ $i + 1 }}">
                                        {{ __('Планировка') }}
                                        <span class="required">*</span>
                                    </label>
                                    <select class="custom_input" name="layout_{{ $i + 1 }}" id="layout_{{ $i + 1 }}">
                                        @for($s = 0; $s < 7; $s++)
                                            <option value="@if($s == 0){{ null }}@else {{ $s }}@endif"
                                            @if($project->layoutSlider[$i] && $project->layoutSlider[$i]->layout == $s) {{__('selected')}} @endif
                                            >
                                                @if($s == 0)
                                                    {{ __('не выводить') }}
                                                @elseif($s == 1)
                                                    {{ __('1 + 1') }}
                                                @elseif($s == 2)
                                                    {{ __('2 + 1') }}
                                                @elseif($s == 3)
                                                    {{ __('3 + 1') }}
                                                @elseif($s == 4)
                                                    {{ __('4 + 1') }}
                                                @elseif($s == 5)
                                                    {{ __('5 + 1') }}
                                                @elseif($s == 6)
                                                    {{ __('6 + 1') }}
                                                @endif

                                            </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="balcony_{{ $i + 1 }}">
                                        {{ __('Количество балконов') }}
                                    </label>
                                    <input class="custom_input" name="balcony_{{ $i + 1 }}" id="balcony_{{ $i + 1 }}" type="number"
                                           value="@isset($project->layoutSlider[$i]){{ $project->layoutSlider[$i]->balcony }}@endisset"
                                           placeholder="{{ __('не выводить') }}"
                                    >
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="quadrature_{{ $i + 1 }}">
                                        {{ __('Квадратура') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input type="number" class="custom_input" name="quadrature_{{ $i + 1 }}" id="quadrature_{{ $i + 1 }}"
                                           @isset($project->layoutSlider[$i])value="{{ $project->layoutSlider[$i]->quadrature }}" @endisset
                                           placeholder="{{ __('не выводить') }}"
                                    >
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="bathroom_{{ $i + 1 }}">
                                        {{ __('Количество санузлов') }}
                                    </label>
                                    <input class="custom_input" name="bathroom_{{ $i + 1 }}" id="bathroom_{{ $i + 1 }}" type="number"
                                           value="@isset($project->layoutSlider[$i]){{ $project->layoutSlider[$i]->bathroom }}@endisset"
                                           placeholder="{{ __('не выводить') }}"
                                    >
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endfor
            @endif
        </div>

        <div class="page-logo">
            <a href="javascript:void(0)" class="add-images float-left">
                <i style="font-size: 25px" data-name="layouts"
                   class="fa fa-plus-circle text-success" aria-hidden="true"></i>
            </a>
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

