<div id="my_modal" class="modal">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">
            @if(!$delete)

                <form id="adminForm"
                      action="@isset($project){{ url('admin/projects/update') }}@else{{ url('admin/projects/create') }}@endisset"
                      method="POST"
                      enctype="multipart/form-data">
                    <h5 class="ml-5 mb-5">{{ __('Название проекта') }}</h5>
                    @isset($project)
                        <input type="hidden" name="id" value="{{ $project->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    @if(count($cities) == 0)
                        <div class="form-group" style="position: relative">
                            <h4 style="color: red">{{ __('Чтобы добавить проект, нужно загрузить хотя бы один город и район!') }}</h4>
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
                                        @isset($project)
                                        @if($project->city !=null && $project->city->id == $city->id) {{__('selected')}} @endif
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

                    <div class="form-group" style="position: relative">
                        <label for="name_en">
                            {{ __('Название проекта EN') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_en" id="name_en" type="text"
                               @isset($project)value="{{ $project->name_en }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_tr">
                            {{ __('Название проекта TR') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_tr" id="name_tr" type="text"
                               @isset($project)value="{{ $project->name_tr }}"@endisset>
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="name_ru">
                            {{ __('Название проекта RU') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input" name="name_ru" id="name_ru" type="text"
                               @isset($project)value="{{ $project->name_ru }}"@endisset>
                    </div>

                    {{-- Изображения проекта --}}
                    <h5 class="m-5">{{ __('Изображения проекта') }}</h5>
                    <div class="box-form-group-img card-grid-two">
                        <div class="form-group-img">
                            <label for="img">
                                {{ __('Изображение каталога') }}
                                <span class="required" style="color: darkred">*</span>
                                <br>
                                {{ __('(min 520 x 320)') }}
                            </label>
                            <div class="img-box mt-3 mb-3" style="width: 320px; height: 197px; background:
                            @if($project)
                                url(/upload/projects/catalog/{{ $project->images->catalog_medium }})
                                @else
                                url(/upload/default_project_catalog.jpg)
                            @endif
                            no-repeat center/cover">
                                <input class="input-img" type="file" name="catalog" onchange="loadImageInput(event, this)">
                            </div>
                            <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                <label for="catalog_alt">
                                    {{ __('описание изображения') }}
                                    <span class="required">*</span>
                                </label>
                                <input class="custom_input  input_alt" id="catalog_alt" type="text" name="catalog_alt" style="height: 25px; font-size: 12px;"
                                value="@isset($project){{ $project->images->catalog_alt }}@endisset">
                            </div>
                        </div>
{{--                        <div class="form-group-img post">--}}
{{--                            <label for="img">--}}
{{--                                {{ __('Изображение карточки') }}--}}
{{--                                <span class="required" style="color: darkred">*</span>--}}
{{--                                <br>--}}
{{--                                {{ __('(min 326 x 326)') }}--}}
{{--                            </label>--}}
{{--                            <div class="img-box mt-3 mb-3 post" style="width: 100px; height: 90px; background:--}}
{{--                            @isset($project)--}}
{{--                                url(/upload/projects/post/{{ $project->images->post_medium }})--}}
{{--                            @else--}}
{{--                                url(/upload/default_project_post_small.jpg)--}}
{{--                            @endisset--}}
{{--                                no-repeat center/cover">--}}
{{--                                <input class="input-img" type="file" name="post" onchange="loadImageInput(event, this)">--}}
{{--                            </div>--}}
{{--                            <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">--}}
{{--                                <label for="post_alt">--}}
{{--                                    {{ __('описание изображения') }}--}}
{{--                                    <span class="required">*</span>--}}
{{--                                </label>--}}
{{--                                <input class="custom_input input_alt" id="post_alt" type="text" name="post_alt" style="height: 25px; font-size: 12px;"--}}
{{--                                       value="@isset($project){{ $project->images->post_alt }}@endisset">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group-img logo">
                            <label for="img">
                                {{ __('Лого') }}
                                <span class="required" style="color: darkred">*</span>
                                <br>
                                {{ __('(min 77 x 55)') }}
                            </label>
                            <div class="img-box mt-3 mb-3" style="width: 76px; height: 55px; background:
                            @isset($project)
                                url(/upload/projects/logo/{{ $project->images->logo }})
                            @else
                                url(/upload/default_project_logo.png)
                            @endisset
                                no-repeat center/cover">
                                <input class="input-img" type="file" name="logo" id="img" onchange="loadImageInput(event, this)">
                            </div>
                            <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                                <label for="logo_alt">
                                    {{ __('описание изображения') }}
                                    <span class="required">*</span>
                                </label>
                                <input class="custom_input input_alt" id="logo_alt" type="text" name="logo_alt" style="height: 25px; font-size: 12px;"
                                       value="@isset($project){{ $project->images->logo_alt }}@endisset">
                            </div>
                        </div>
                    </div>

                    {{-- Блок с информацией --}}
                    <h5 class="m-5">{{ __('Блоки с информацией') }}</h5>
                    <div class="card-grid-trio">
                        <div class="form-group" style="position: relative">
                            <label for="deadline">
                                {{ __('Срок сдачи') }}
                            </label>
                            <span class="required">*</span>
                            <input type="date" class="custom_input" name="deadline" id="deadline"
                                   @isset($project)value="{{ $project->deadline }}" @endisset
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="floors">
                                {{ __('Этажность') }}
                            </label>
                            <input class="custom_input" name="floors" id="floors" type="number"
                                   @isset($project)value="{{ $project->floors }}"@endisset
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="sea">
                                {{ __('До моря') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="sea" id="sea" type="number"
                                   @isset($project)value="{{ $project->sea }}"@endisset
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
                                    @if($project && $project->gas == $i) {{__('selected')}} @endif
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
                            <label for="layouts">
                                {{ __('Планировки') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="layouts" id="layouts" type="text"
                            value="@isset($project){{ $project->layouts }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="price">
                                {{ __('Цены') }}
                                <span class="required">*</span>
                            </label>
                            <input class="custom_input" name="price" id="price" type="number"
                            value="@isset($project){{ $project->price }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="аidat">
                                {{ __('Айдат') }}
                            </label>
                            <input class="custom_input" name="аidat" id="аidat" type="number"
                                   value="@isset($project){{ $project->аidat }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="availability">
                                {{ __('Наличие квартир') }}
                            </label>
                            <input class="custom_input" name="availability" id="availability" type="number"
                                   value="@isset($project){{ $project->availability }}@endisset"
                                   placeholder="{{ __('не выводить') }}"
                            >
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="installments">
                                {{ __('Рассрочка') }}
                            </label>
                            <select class="custom_input" name="installments" id="installments">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($project && $project->installments == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->pool == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->sauna == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->hammam == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->fitness == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->relaxation == $i) {{__('selected')}} @endif
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
                                    @if($project && $project->barbecue == $i) {{__('selected')}} @endif
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
                        </div><div class="form-group" style="position: relative">
                            <label for="sport">
                                {{ __('Спорт площадка') }}
                            </label>
                            <select class="custom_input" name="sport" id="sport">
                                @for($i = 0; $i < 3; $i++)
                                    <option value="@if($i == 0){{ null }}@else {{ $i }}@endif"
                                    @if($project && $project->sport == $i) {{__('selected')}} @endif
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
                <form id="adminForm" action="{{ url('admin/projects/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <input class="custom_input" name="name_ru" id="name_ru" type="hidden"
                           value="{{ $project->name_ru }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ $project->name_ru }}{{ __('?') }}</h3>
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
