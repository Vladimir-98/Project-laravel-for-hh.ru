<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">{{ __('pедактирование описания инфраструктуры') }}</h5>
</div>
<div class="card-form ">
    <input type="hidden" name="project" id="pageComponent">
    <form id="adminForm" action="{{ url('admin/projects/show/infrastructure-update') }}" method="POST">
        <input type="hidden" value="{{ $project->id }}" name="infrastructure" id="currentPage">
{{--        <input type="hidden" name="description_id" value="@if(isset($project->description)){{ $project->description->id }}@endif">--}}
        <input type="hidden" value="{{ $project->id }}" name="project_id" id="currentSortId">
        @csrf
        <!======= INFRASTRUCTURE  DESCRIPTION EN ========>
        <div class="form-group" style="position: relative">
            <label for="title_en" style="color: #1a202c">
                {{ __('Заголовок описания инфраструктуры EN') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_en" id="title_en" type="text"
                   @isset($project->infrastructure)value="{{ $project->infrastructure->title_en }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_en">
                {{ __('Описание инфраструктуры EN') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($project->infrastructure){!! $project->infrastructure->description_en !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_en" id="description_en" type="text"
                      style="display: none">
                @isset($project->infrastructure){{ $project->infrastructure->description_en }}@endisset
            </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <!======= INFRASTRUCTURE TR ========>

        <div class="form-group" style="position: relative">
            <label for="title_tr" style="color: #1a202c">
                {{ __('Заголовок описания инфраструктуры TR') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_tr" id="title_tr" type="text"
                   @isset($project->infrastructure)value="{{ $project->infrastructure->title_tr }}"@endisset>
        </div>

        <div class="form-group" style="position: relative">
            <label for="description_tr">
                {{ __('Описание инфраструктуры TR') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($project->infrastructure){!! $project->infrastructure->description_tr !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_tr" id="description_tr" type="text"
                      style="display: none">
                @isset($project->infrastructure){{ $project->infrastructure->description_tr }}@endisset
            </textarea>
        </div>

        <hr class="mt-4 mb-4">

        <!======= INFRASTRUCTURE RU ========>
        <div class="form-group" style="position: relative">
            <label for="title_ru" style="color: #1a202c">
                {{ __('Заголовок описания инфраструктуры RU') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="title_ru" id="title_ru" type="text"
                   @isset($project->infrastructure)value="{{ $project->infrastructure->title_ru }}"@endisset>
        </div>
        <div class="form-group" style="position: relative">
            <label for="description_ru">
                {{ __('Описание инфраструктуры RU') }}
                <span class="required">*</span>
            </label>
            @include('layouts.admin.layouts.contenteditable')
            <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                 style="min-height: 400px">
                <div class="box-form-group-img admin-box-img mb-0" contenteditable="false"
                     style="float: left; margin-right: 32px; margin-top: calc(10px - 30px);">
                </div>
                <div
                    class="textEdit">@isset($project->infrastructure){!! $project->infrastructure->description_ru !!}@else{{ __('Описание...') }}@endisset</div>
            </div>
            <textarea class="custom_input" name="description_ru" id="description_ru" type="text"
                      style="display: none">
                @isset($project->infrastructure){{ $project->infrastructure->description_ru }}@endisset
            </textarea>
        </div>
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($project->infrastructure))
                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('infrastructure-delete', @if(!empty($project->infrastructure)){{ $project->infrastructure->id }})@endif;">
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
