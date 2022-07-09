<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">
            @if(!$delete)

                <form id="adminForm"
                      action="@isset($apartments){{ url('admin/apartments/update') }}@else{{ url('admin/apartments/create') }}@endisset"
                      method="POST"
                      enctype="multipart/form-data">
                    <h5 class="ml-5 mb-5">{{ __('Название квартиры') }}</h5>
                    @isset($apartments)
                        <input type="hidden" name="id" value="{{ $apartments->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    @if(count($cities) == 0)
                        <div class="form-group" style="position: relative">
                            <h4 style="color: red">{{ __('Чтобы добавить квартиру, нужно загрузить хотя бы один город и район!') }}</h4>
                        </div>
                    @else
                        <div class="form-group" style="position: relative">
                            <label for="city_id">
                                {{ __('Выбрать город') }}
                                <span class="required">*</span>
                            </label>
                            <select class="custom_input option_city" name="city_id" id="city_id" type="text">
                                @foreach($cities as $city)
                                    <option
                                        @isset($apartments)
                                        @if($apartments->city !=null && $apartments->city->id == $city->id) {{__('selected')}} @endif
                                        @endisset
                                        value="{{ $city->id }}">
                                        {{ $city->name_ru }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="selectDistrict">
                            @include('admin.districts.option')
                        </div>
                    @endif
                    {{-- Изображения проекта --}}
                    <h5 class="m-5">{{ __('Изображения квартиры') }}</h5>
                    <div class="box-form-group-img card-grid-trio">
                        <div class="form-group-img post">
                            <label for="img">
                                {{ __('Изображение карточки') }}
                                <span class="required">*</span>
                                <br>
                                {{ __('(min 326 x 326)') }}
                            </label>
                            <div class="img-box mt-3 mb-3 post" style="width: 100px; height: 90px; background:
                            @isset($apartments)
                                url(/upload/apartments/post/{{ $apartments->images->post_small }})
                            @else
                                url(/upload/default_project_post_small.jpg)
                            @endisset
                                no-repeat center/cover">
                                <input class="input-img" type="file" name="post" onchange="loadImageInput(event, this)">
                            </div>
                            <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                <label for="post_alt">
                                    {{ __('описание изображения') }}
                                    <span class="required">*</span>
                                </label>
                                <input class="custom_input input_alt" id="post_alt" type="text" name="post_alt" style="height: 25px; font-size: 12px;"
                                       value="@isset($apartments){{ $apartments->images->post_alt }}@endisset">
                            </div>
                        </div>
                    </div>

                    {{-- Блок с информацией --}}
                    <h5 class="m-5">{{ __('Блоки с информацией') }}</h5>
                    <div class="card-grid-trio">
{{--                        @if(count($projects) !==0 )--}}
                            <div class="form-group" style="position: relative">
                                <label for="project_id">
                                    {{ __('Проект') }}
                                </label>
                                <select class="custom_input" name="project_id" id="project_id">
                                    <option value="0">{{ __('не выводить') }}</option>
                                    @foreach($projects as $project)
                                        <option
                                            @isset($apartments)
                                            @if($apartments->project_id !=null && $apartments->project_id == $project->id) {{__('selected')}} @endif
                                            @endisset
                                            value="{{ $project->id }}">{{ $project->name_ru }}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                        @endif--}}
{{--                        <div class="form-group" style="position: relative">--}}
{{--                            <label for="property_type">--}}
{{--                                {{ __('Тип недвижимости') }}--}}
{{--                            </label>--}}
{{--                            <select class="custom_input" name="property_type" id="property_type">--}}
{{--                                @for($i = 0; $i < 4; $i++)--}}
{{--                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"--}}
{{--                                    @if($apartments && $apartments->property_type == $i) {{__('selected')}} @endif--}}
{{--                                    >--}}
{{--                                        @if($i == 0)--}}
{{--                                            {{ __('не выводить') }}--}}
{{--                                        @elseif($i == 1)--}}
{{--                                            {{ __('квартира') }}--}}
{{--                                        @elseif($i == 2)--}}
{{--                                            {{ __('апартаменты') }}--}}
{{--                                        @elseif($i == 3)--}}
{{--                                            {{ __('вилла') }}--}}
{{--                                        @endif--}}
{{--                                    </option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="form-group" style="position: relative">
                            <label for="age">
                                {{ __('Год постройки') }}
                            </label>
                            <input type="date" class="custom_input" name="age" id="age"
                                   @isset($project)value="{{ $project->age }}" @endisset
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="quadrature">
                                {{ __('Квадратура') }}
                                <span class="required">*</span>
                            </label>
                            <input type="number" class="custom_input" name="quadrature" id="quadrature"
                                   @isset($apartments)value="{{ $apartments->quadrature }}" @endisset
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="status">
                                {{ __('Статус продажи') }}
                            </label>
                            <select class="custom_input" name="status" id="status">
                                @for($i = 0; $i < 2; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->status == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('срочная продажа') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="floor">
                                {{ __('Этаж') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="floor" id="floor" type="number"
                                   @isset($apartments)value="{{ $apartments->floor }}"@endisset
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="floors">
                                {{ __('Этажность дома') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="floors" id="floors" type="number"
                                   @isset($apartments)value="{{ $apartments->floors }}"@endisset
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="sea">
                                {{ __('До моря') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="sea" id="sea" type="number"
                                   @isset($apartments)value="{{ $apartments->sea }}"@endisset
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="gas">
                                {{ __('Газ') }}
                            </label>
                            <select class="custom_input" name="gas" id="gas">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->gas == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="layout">
                                {{ __('Планировка') }}
                                <span class="required">*</span>
                            </label>
                            <select class="custom_input" name="layout" id="layout">
                                @for($i = 0; $i < 7; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->layout == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('1 + 1') }}
                                        @elseif($i == 2)
                                            {{ __('2 + 1') }}
                                        @elseif($i == 3)
                                            {{ __('3 + 1') }}
                                        @elseif($i == 4)
                                            {{ __('4 + 1') }}
                                        @elseif($i == 5)
                                            {{ __('5 + 1') }}
                                        @elseif($i == 6)
                                            {{ __('6 + 1') }}
                                        @endif

                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="price">
                                {{ __('Цена') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="price" id="price" type="number"
                            value="@isset($apartments){{ $apartments->price }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="аidat">
                                {{ __('Айдат') }}
                            </label>
                            <input class="custom_input" name="аidat" id="аidat" type="number"
                                   value="@isset($apartments){{ $apartments->аidat }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="balcony">
                                {{ __('Количество балконов') }}
                            </label>
                            <input class="custom_input" name="balcony" id="balcony" type="number"
                                   value="@isset($apartments){{ $apartments->balcony }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="bathroom">
                                {{ __('Количество санузлов') }}
                            </label>
                            <input class="custom_input" name="bathroom" id="bathroom" type="number"
                                   value="@isset($apartments){{ $apartments->bathroom }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="bedroom">
                                {{ __('Количество спален') }}
                            </label>
                            <input class="custom_input" name="bedroom" id="bedroom" type="number"
                                   value="@isset($apartments){{ $apartments->bedroom }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="kitchen">
                                {{ __('Расположение кухни') }}
                            </label>
                            <select class="custom_input" name="kitchen" id="kitchen">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->kitchen == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('совмещенная') }}
                                        @else
                                            {{ __('отдельная') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="furniture">
                                {{ __('Мебель') }}
                            </label>
                            <select class="custom_input" name="furniture" id="gas">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->furniture == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="pool">
                                {{ __('Бассейн') }}
                            </label>
                            <select class="custom_input" name="pool" id="pool">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->pool == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="sauna">
                                {{ __('Сауна') }}
                            </label>
                            <select class="custom_input" name="sauna" id="sauna">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->sauna == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="hammam">
                                {{ __('Хаммам') }}
                            </label>
                            <select class="custom_input" name="hammam" id="hammam">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->hammam == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="fitness">
                                {{ __('Фитнес зал') }}
                            </label>
                            <select class="custom_input" name="fitness" id="fitness">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->fitness == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="relaxation">
                                {{ __('Зона отдыха') }}
                            </label>
                            <select class="custom_input" name="relaxation" id="relaxation">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->relaxation == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="barbecue">
                                {{ __('Зона барбекю') }}
                            </label>
                            <select class="custom_input" name="barbecue" id="barbecue">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->barbecue == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="sport">
                                {{ __('Спорт площадка') }}
                            </label>
                            <select class="custom_input" name="sport" id="sport">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($apartments && $apartments->sport == $i) {{__('selected')}} @endif
                                    >
                                        @if($i == 0)
                                            {{ __('не выводить') }}
                                        @elseif($i == 1)
                                            {{ __('есть') }}
                                        @else
                                            {{ __('нет') }}
                                        @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button data-name="project" type="button" class="btn btn-blue form_btn">
                                {{ __('сохранить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <form id="adminForm" action="{{ url('admin/apartments/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $apartments->id }}">
                    <input class="custom_input" name="name_ru" id="name_ru" type="hidden"
                           value="{{ $apartments->name_ru }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $apartments->name_ru }}{{ __('?') }}</h3>
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
