<!====== MAP =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">
        {{ __('редактирование карты') }}
    </h5>
</div>
<div class="card-form map">
    <input type="hidden" name="map" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="map" id="currentPage">
    <form id="adminForm"
          action="{{ url('admin/pages/show/map-update') }}"
          method="POST">
        <input type="hidden" name="map_gable_id" value="{{ $page->id }}">
        <input type="hidden" name="map_gable_type" value="{{ __('App\Models\Admin\Page') }}">
        @method('PUT')

        <div class="form-group" style="position: relative">
            <label for="url" style="color: #1a202c">
                {{ __('Ссылка на карту') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="url" id="urlMap" type="text"
                   @if(!empty($page->map))value="{{ $page->map->url }}" @endif
                   placeholder="{{ __('Вставить <iframe>...</iframe>') }} {{ $page->id }}">
        </div>
        @if (!empty($page->map))
            <iframe src="{{ $page->map->url }}" style="border:0;"></iframe>
        @endif

        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($page->map))
                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('map-delete', @if(!empty($page->map)){{ $page->map->id }})@endif;">
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


