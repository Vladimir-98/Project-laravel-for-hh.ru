<!====== HEADER =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">{{ __('редактирование 3d plan') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="plan" id="pageComponent">
    <form id="adminForm"
          action="@if(!empty($project->plan)){{ url('admin/projects/update-plan-image') }}@else{{ url('admin/projects/add-plan-image') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if($project->plan)
            <input type="hidden" value="{{ $project->plan->id }}" name="plan_id">
            @method('PUT')
        @else
            @csrf
        @endif
        <input type="hidden" value="{{ $project->id }}" name="plan" id="currentPage">
        <input type="hidden" value="{{ $project->id }}" name="project_id">
        <input type="hidden" id="currentSortId">
        <div class="checkbox">
{{--            <input class="custom-checkbox one-checked @if($project->plan->status) checked @endif" type="checkbox"  name="status" value="@if($project->plan->status){{ __('1') }}@else{{ __('2') }}@endif">--}}
{{--            <label>--}}
{{--                <span class="price">{{ __('Не выводить') }}</span>--}}
{{--            </label>--}}
        </div>
        <h6 class="mt-5 text-center">{{ __('Изображение') }}</h6>
        <div class="form-group mt-5" style="position: relative">
            <label for="title_en">
                {{ __('Заголовок блока EN') }}
            </label>
            <input class="custom_input" name="title_en" id="title_en" type="text" style="height: 35px"
                   @isset($project->plan->title_en)value="{{ $project->plan->title_en }}"@endisset>
        </div>
        <div class="form-group mt-5" style="position: relative">
            <label for="title_tr">
                {{ __('Заголовок блока TR') }}
            </label>
            <input class="custom_input" name="title_tr" id="title_tr" type="text" style="height: 35px"
                   @isset($project->plan->title_tr)value="{{ $project->plan->title_tr }}"@endisset>
        </div>
        <div class="form-group mt-5" style="position: relative">
            <label for="title_ru">
                {{ __('Заголовок блока RU') }}
            </label>
            <input class="custom_input" name="title_ru" id="title_ru}" type="text" style="height: 35px"
                   @isset($project->plan->title_ru)value="{{ $project->plan->title_ru }}"@endisset>
        </div>
        <div class="box-form-group-img card-grid-trio project_slider-grid" style="gap: 0;">
            <div class="add-block">
                <div class="form-group-img pt-0 ">
                    <label for="image" class="d-flex">
                        <div class="mx-auto">
                            {{ __('(min 850 x 560)') }}
                            <span class="required" style="color: darkred">*</span>
                        </div>
                    </label>
                    <div class="img-box mt-3 mb-3 "
                         style="width: 100%; background:
                         @isset($project->plan->image)
                             url(/upload/projects/plan/{{ $project->plan->image }})
                         @else
                             url(/upload/default_project_catalog.jpg)
                         @endisset
                             no-repeat center/cover"><input class="input-img" id="image" type="file" name="image"
                                                            onchange="loadImageInput(event, this)">
                    </div>

                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="image_alt"> {{ __('описание изображения') }} <span class="required">*</span></label>
                        <input class="custom_input input_alt" id="image_alt" type="text"
                               name="image_alt"
                               style="height: 25px; font-size: 12px;"
                               @isset($project->plan)value="{{ $project->plan->image_alt }}" @endisset
                        >
                    </div>
                </div>
            </div>
        </div>
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($project->plan))
                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('plan-delete', @if(!empty($project->plan)){{ $project->plan->id }})@endif;">
                        {{ __('удалить') }}
                    </button>
                @endif
                <button data-name="city" type="button" class="btn btn-blue form_btn">
                    {{ __('сохранить') }}
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .card-form .box-form-group-img .form-group-img .img-box {
        height: 560px;
    }
    @media (max-width: 850px) {
        .card-form .box-form-group-img .form-group-img .img-box {
            height: 237px;
        }
    }
</style>
