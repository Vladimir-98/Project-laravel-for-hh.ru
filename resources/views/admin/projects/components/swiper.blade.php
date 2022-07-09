<!====== HEADER =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">{{ __('редактирование верхнего слайдер') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="slider" id="pageComponent">
    <form id="adminForm"
          action="@if(count($project->sliders)){{ url('admin/projects/update-images') }}@else{{ url('admin/projects/add-images') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if(count($project->sliders))
            @method('PUT')
        @else
            @csrf
        @endif
        <input type="hidden" value="{{ $project->id }}" name="slider" id="currentPage">
        <input type="hidden" value="{{ $project->id }}" name="project_id">
        <input type="hidden" id="currentSortId">
        <div class="box-form-group-img card-grid-trio project_slider-grid" style="gap: 0;">
            @if (count($project->sliders))
                @for($i = 0; $i < count($project->sliders); $i++)
                    <div class="add-block">
                        <h6 class="mt-3 text-center">{{ __('слайдер №') }}{{ $i + 1 }}</h6>
                        <div class="row">
                            <div class="form-group-img pt-0 col-md-12">
                                <label for="image_{{ $i + 1 }}" class="d-flex">
                                    <div class="mx-auto">
                                        {{ $i + 1 }}{{ __(' - ') }}{{ __('(min 970 x 455)') }}
                                        <span class="required" style="color: darkred">*</span>
                                    </div>
                                    <div class="page-logo">
                                        <a href="javascript:void(0)" class="sort_by float-right">
                                            <i style="font-size: 17px" data-id="{{ $project->sliders[$i]->id }}" class="delete-images fa fa-trash text-danger"
                                               aria-hidden="true"></i>
                                            <input type="hidden" name="projects/delete-image/" value="{{ $project->sliders[$i]->id }}">
                                        </a>
                                    </div>
                                </label>
                                <div class="img-box mt-3 mb-3 swiper-project-admin"
                                     style="background: url(/upload/projects/slider/{{ $project->sliders[$i]->image }})no-repeat center/cover">
                                    <input class="input-img" id="image_{{ $i + 1 }}" type="file" name="image_{{ $i + 1 }}" onchange="loadImageInput(event, this)">
                                </div>
                                <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                    <label for="image_alt_{{ $i + 1 }}"> {{ __('описание изображения') }} <span class="required">*</span></label>
                                    <input class="custom_input input_alt" id="image_alt_{{ $i + 1 }}" type="text"
                                           name="image_alt_{{ $i + 1 }}"
                                           style="height: 25px; font-size: 12px;"
                                           value="{{ $project->sliders[$i]->image_alt }}">
                                    <input type="hidden" value="{{ $project->sliders[$i]->id }}" name="id_{{ $i + 1 }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-5" style="position: relative">
                                    <label for="title_en_{{ $i + 1 }}">
                                        {{ __('Заголовок изображения EN') }}
                                    </label>
                                    <input class="custom_input" name="title_en_{{ $i + 1 }}" id="title_en_{{ $i + 1 }}" type="text" style="height: 35px"
                                           @isset($project->sliders[$i]->title_en)value="{{ $project->sliders[$i]->title_en }}"@endisset>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="description_en_{{ $i + 1 }}">
                                        {{ __('Описание EN') }}
                                    </label>
                                    @include('layouts.admin.layouts.contenteditable')
                                    <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">
                                        <div class="textEdit">@if(!empty($project->sliders[$i]->description_en)){!! $project->sliders[$i]->description_en !!}@else{{ __('Описание...') }}@endif</div>
                                    </div>
                                    <textarea class="custom_input" name="description_en_{{ $i + 1 }}" id="description_en_{{ $i + 1 }}" type="text" style="display: none">
                                        @if(!empty($project->sliders[$i]->description_en)){{ $project->sliders[$i]->description_en }}@endif
                                    </textarea>
                                </div>

                                <div class="form-group mt-5" style="position: relative">
                                    <label for="title_tr_{{ $i + 1 }}">
                                        {{ __('Заголовок изображения TR') }}
                                    </label>
                                    <input class="custom_input" name="title_tr_{{ $i + 1 }}" id="title_tr_{{ $i + 1 }}" type="text" style="height: 35px"
                                           @isset($project->sliders[$i]->title_tr)value="{{ $project->sliders[$i]->title_tr }}"@endisset>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="description_tr_{{ $i + 1 }}">
                                        {{ __('Описание TR') }}
                                    </label>
                                    @include('layouts.admin.layouts.contenteditable')
                                    <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">
                                        <div class="textEdit">@if(!empty($project->sliders[$i]->description_tr)){!! $project->sliders[$i]->description_tr !!}@else{{ __('Описание...') }}@endif</div>
                                    </div>
                                    <textarea class="custom_input" name="description_tr_{{ $i + 1 }}" id="description_tr_{{ $i + 1 }}" type="text" style="display: none">
                                        @if(!empty($project->sliders[$i]->description_tr)){{ $project->sliders[$i]->description_tr }}@endif
                                    </textarea>
                                </div>


                                <div class="form-group mt-5" style="position: relative">
                                    <label for="title_ru_{{ $i + 1 }}">
                                        {{ __('Заголовок изображения RU') }}
                                    </label>
                                    <input class="custom_input" name="title_ru_{{ $i + 1 }}" id="title_ru_sliders{{ $i + 1 }}" type="text" style="height: 35px"
                                           @isset($project->sliders[$i]->title_ru)value="{{ $project->sliders[$i]->title_ru }}"@endisset>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="description_ru_{{ $i + 1 }}">
                                        {{ __('Описание RU') }}
                                    </label>
                                    @include('layouts.admin.layouts.contenteditable')
                                    <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)" style="min-height: 100px">
                                        <div class="textEdit">@if(!empty($project->sliders[$i]->description_ru)){!! $project->sliders[$i]->description_ru !!}@else{{ __('Описание...') }}@endif</div>
                                    </div>
                                    <textarea class="custom_input" name="description_ru_{{ $i + 1 }}" id="description_ru_{{ $i + 1 }}" type="text" style="display: none">
                                        @if(!empty($project->sliders[$i]->description_ru)){{ $project->sliders[$i]->description_ru }}@endif
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-4 mb-4">
                    </div>
                @endfor
            @endif
        </div>

        <div class="page-logo">
            <a href="javascript:void(0)" class="add-images float-left">
                <i style="font-size: 25px" data-name="project-top"
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

<style>
    .swiper-project-admin{
        width: 100%;
        height: 400px;
    }

    @media (max-width: 768px) {
        .swiper-project-admin{
            height: 347px;
        }
    }
    @media (max-width: 424px) {
        .swiper-project-admin{
            height: 172px;
        }
    }
</style>
