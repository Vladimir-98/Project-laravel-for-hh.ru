<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">

            @if(!$delete)
                <form id="adminForm"
                      action="@isset($district){{ url('admin/districts/update') }}@else{{ url('admin/districts/create') }}@endisset"
                      method="POST">
                    @isset($district)
                        <input type="hidden" name="id" value="{{ $district->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    <div class="form-group" style="position: relative">
                        @if(count($cities) == 0)
                            <h4 style="color: red">{{ __('Чтобы добавить район, нужно загрузить хотя бы один город!') }}</h4>
                        @else
                            <label for="city_id">
                                {{ __('Выбрать город') }}
                                <span class="required">*</span>
                            </label>
                            <select class="custom_input" name="city_id" id="city_id" type="text">
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}"
                                            @isset($district) @if($city->id === $district->city_id) selected @endif @endisset
                                    >{{ $city->name_ru }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_en">
                            {{ __('Название района EN') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_en" id="name_en" type="text"
                               @isset($district)value="{{ $district->name_en }}"
                               placeholder="{{ $city->name_en }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_tr">
                            {{ __('Название района TR') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_tr" id="name_tr" type="text"
                               @isset($district)value="{{ $district->name_tr }}"
                               placeholder="{{ $district->name_tr }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_ru">
                            {{ __('Название района RU') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_ru" id="name_ru" type="text"
                               @isset($district)value="{{ $district->name_ru }}"
                               placeholder="{{ $district->name_ru }}"@endisset>
                    </div>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button data-name="district" type="button" class="btn btn-blue form_btn">
                                {{ __('сохранить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <form id="adminForm" action="{{ url('admin/districts/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $district->id }}">
                    <input class="custom_input" name="name_en" id="name_en" type="hidden"
                           value="{{ $district->name_en }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $district->name_ru }}{{ __('?') }}</h3>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button type="button" class="btn btn-danger form_btn">
                                {{ __('удалить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
