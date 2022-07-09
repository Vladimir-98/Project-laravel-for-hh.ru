
<!====== MAP =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $project->name_ru }}</h3>
    <h5 class="mt-2">
        {{ __('редактирование видео') }}
    </h5>
</div>
<div class="card-form map">
    <input type="hidden" name="video" id="pageComponent">
    <form id="adminForm"
          action="{{ url('admin/projects/show/video-update') }}"
          method="POST">
        <input type="hidden" name="video_gable_id" value="{{ $project->id }}">
        <input type="hidden" name="video_gable_type" value="{{ __('App\Models\Admin\Project') }}">
        <input type="hidden" value="{{ $project->id }}" name="video" id="currentPage">
        <input type="hidden" value="{{ $project->id }}" name="project_id">
        <input type="hidden" id="currentSortId">
        @method('PUT')

        <div class="form-group" style="position: relative">
            <label for="url" style="color: #1a202c">
                {{ __('Ссылка на видео') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="youtube" id="urlMap" type="text"
                   @isset($project->video)value="{{ $project->video->url }}" @endisset
                   placeholder="{{ __('Вставить <iframe>...</iframe>') }}">
        </div>
        @if (!empty($project->video))
            <iframe src="{{ $project->video->url }}" style="border:0;"></iframe>
        @endif
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($project->video))
                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('video-delete', @if(!empty($project->video)){{ $project->video->id }})@endif;">
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
