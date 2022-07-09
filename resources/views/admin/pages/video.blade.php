
<!====== MAP =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">
        {{ __('редактирование видео') }}
    </h5>
</div>
<div class="card-form map">
    <input type="hidden" name="video" id="pageComponent">
    <form id="adminForm"
          action="{{ url('admin/pages/show/video-update') }}"
          method="POST">
        <input type="hidden" value="{{ $page->id }}" name="video" id="currentPage">
        <input type="hidden" value="{{ $page->id }}" name="page_id">
        <input type="hidden" id="currentSortId">
        @method('PUT')
        <div class="form-group" style="position: relative">
            <label for="url" style="color: #1a202c">
                {{ __('Ссылка на видео') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="url" id="urlMap" type="text"
                   @isset($page->video)value="{{ $page->video->url }}" @endisset
                   placeholder="{{ __('Вставить <iframe>...</iframe>') }}">
        </div>
        @if (!empty($page->video))
            <iframe src="{{ $page->video->url }}" style="border:0;"></iframe>
        @endif
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($page->video))
                    <button type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('video-delete', @if(!empty($page->video)){{ $page->video->id }})@endif">
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
