<!======    PROJECT PROGRESS =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">{{ __('редактирование хода строительства') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="progress" id="pageComponent">
    <form id="adminForm"
          action="@if(count($project->progress)){{ url('admin/projects/update-progress') }}@else{{ url('admin/projects/add-progress') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if(count($project->progress))
            @method('PUT')
        @else
            @csrf
        @endif
        <input type="hidden" value="{{ $project->id }}" name="progress" id="currentPage">
        <input type="hidden" value="{{ $project->id }}" name="project_id">
        @if(!empty($project->progressTitle->title_en))
            <input type="hidden" name="title_id" value="{{ $project->progressTitle->title_en }}">
        @endif
        <input type="hidden" id="currentSortId">
        <!======= PROGRESS EN ========>
        <div class="form-group" style="position: relative">
            <label for="title_en" style="color: #1a202c">
                {{ __('Заголовок хода строительства EN') }}
            </label>
            <input class="custom_input" name="title_en" id="title_en" type="text"
                   @if(!empty($project->progressTitle->title_en))value="{{ $project->progressTitle->title_en }}"@endif>
        </div>

        <!======= PROGRESS TR ========>

        <div class="form-group" style="position: relative">
            <label for="title_tr" style="color: #1a202c">
                {{ __('Заголовок хода строительства TR') }}
            </label>
            <input class="custom_input" name="title_tr" id="title_tr" type="text"
                   @if(!empty($project->progressTitle->title_tr))value="{{ $project->progressTitle->title_tr }}"@endif>
        </div>

        <!======= PROGRESS RU ========>
        <div class="form-group" style="position: relative">
            <label for="title_ru" style="color: #1a202c">
                {{ __('Заголовок хода строительства RU') }}
            </label>
            <input class="custom_input" name="title_ru" id="title_ru" type="text"
                   @if(!empty($project->progressTitle))value="{{ $project->progressTitle->title_ru }}"@endif>
        </div>

        <div class="box-form-group-img card-grid-trio project_slider-grid" style="gap: 0;">
            @if (count($project->progress))
                @for($i = 0; $i < count($project->progress); $i++)
                    <div class="add-block">
                        <h6 class="mt-5 text-center">{{ __('шаг №') }}{{ $i + 1 }}</h6>
                        <div class="row">
                            <div class="form-group-img pt-0 col-md-6">
                                <label for="image_{{ $i + 1 }}" class="d-flex">
                                    <div class="mx-auto">
                                        {{ $i + 1 }}{{ __(' - ') }}{{ __('(min 380 x 185)') }}
                                        <span class="required" style="color: darkred">*</span>
                                    </div>
                                    <div class="page-logo">
                                        <a href="javascript:void(0)" class="sort_by float-right">
                                            <i style="font-size: 17px" data-id="{{ $project->progress[$i]->id }}" class="delete-images fa fa-trash text-danger"
                                               aria-hidden="true"></i>
                                            <input type="hidden" name="projects/delete-progress/" value="{{ $project->progress[$i]->id }}">
                                        </a>
                                    </div>
                                </label>
                                <div class="img-box mt-3 mb-3"
                                     style="width: 360px; height: 176px; background: url(/upload/projects/progress/{{ $project->progress[$i]->image }})no-repeat center/cover">
                                    <input class="input-img" id="image_{{ $i + 1 }}" type="file" name="image_{{ $i + 1 }}" onchange="loadImageInput(event, this)">
                                </div>

                                <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                    <label for="image_alt_{{ $i + 1 }}"> {{ __('описание изображения') }} <span class="required">*</span></label>
                                    <input class="custom_input input_alt" id="image_alt_{{ $i + 1 }}" type="text"
                                           name="image_alt_{{ $i + 1 }}"
                                           style="height: 25px; font-size: 12px;"
                                           value="{{ $project->progress[$i]->image_alt }}">
                                    <input type="hidden" value="{{ $project->progress[$i]->id }}" name="id_{{ $i + 1 }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group" style="position: relative">
                                    <label for="title_img_en_{{ $i + 1 }}" style="color: #1a202c">
                                        {{ __('Заголовок изображения EN') }}
                                    </label>
                                    <input class="custom_input" name="title_img_en_{{ $i + 1 }}" id="title_img_en_{{ $i + 1 }}" type="text"
                                           @if($project->progress[$i]->title_img_en)value="{{ $project->progress[$i]->title_img_en }}"@endif>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="title_img_tr_{{ $i + 1 }}" style="color: #1a202c">
                                        {{ __('Заголовок изображения TR') }}
                                    </label>
                                    <input class="custom_input" name="title_img_tr_{{ $i + 1 }}" id="title_img_tr_{{ $i + 1 }}" type="text"
                                           @if($project->progress[$i]->title_img_tr)value="{{ $project->progress[$i]->title_img_tr }}"@endif>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="title_img_ru_{{ $i + 1 }}" style="color: #1a202c">
                                        {{ __('Заголовок изображения RU') }}
                                    </label>
                                    <input class="custom_input" name="title_img_ru_{{ $i + 1 }}" id="title_img_ru_{{ $i + 1 }}" type="text"
                                           @if($project->progress[$i]->title_img_ru)value="{{ $project->progress[$i]->title_img_ru }}"@endif>
                                </div>

                                <div class="form-group" style="position: relative">
                                    <label for="date_{{ $i + 1 }}">
                                        {{ __('Дата') }}
                                    </label>
                                    <input class="custom_input" name="date_{{ $i + 1 }}" id="date_{{ $i + 1 }}" type="date"
                                           @isset($project->progress[$i])value="{{ $project->progress[$i]->date }}" @endisset
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
                <i style="font-size: 25px" data-name="progress"
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

