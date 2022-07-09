
<!====== MAP =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ __('Квартира ') }}{{ $apartment->layout }}{{ __('+1 - ') }}  {{ $apartment->city->name_ru }}{{__(' (')}}{{ $apartment->district->name_ru }}{{__(')')}}</h3>
    <h5 class="mt-2">
        {{ __('редактирование карты') }}
    </h5>
</div>
<div class="card-form map">
    <input type="hidden" name="map" id="pageComponent">
    <form id="adminForm"
          action="{{ url('admin/apartments/show/map-update') }}"
          method="POST">
        <input type="hidden" name="map_gable_id" value="{{ $apartment->id }}">
        <input type="hidden" name="map_gable_type" value="{{ __('App\Models\Admin\Apartments') }}">
        <input type="hidden" value="{{ $apartment->id }}" name="map" id="currentPage">
        <input type="hidden" value="{{ $apartment->id }}" name="apartment_id">
        <input type="hidden" id="currentSortId">
        @method('PUT')

        <div class="form-group" style="position: relative">
            <label for="url" style="color: #1a202c">
                {{ __('Ссылка на карту') }}
                <span class="required">*</span>
            </label>
            <input class="custom_input" name="url" id="urlMap" type="text"
                   @isset($apartment->map)value="{{ $apartment->map->url }}" @endisset
                   placeholder="{{ __('Вставить <iframe>...</iframe>') }}">
        </div>
        @if (!empty($apartment->map))
            <iframe src="{{ $apartment->map->url }}" style="border:0;"></iframe>
        @endif
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                @if(!empty($apartment->map))
                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('map-delete', @if(!empty($apartment->map)){{ $apartment->map->id }})@endif;">
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
