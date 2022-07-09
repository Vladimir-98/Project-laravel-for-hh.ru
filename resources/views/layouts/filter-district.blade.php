
@if (count($districts) != 0)
    <div class="nav-link" onclick="getSidebarDropdown(this, '')">
        <div class="down-icon"
             style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
        <a href="javascript:void(0)">{{ __('район') }}</a>
    </div>
    <div class="nav-link-dropdown">
        @foreach($districts as $key => $district)
            <div class="checkbox">
                <input class="custom-checkbox one-checked"
                       name="district_id"
                       type="checkbox"
                       value="{{ $district->id }}">
                <label>
                <span class="price">
                    {{ $district['name_'.$lang] }}
                </span>
                </label>
            </div>
        @endforeach
            <div class="checkbox">
                <input class="custom-checkbox one-checked"
                       name="district_id"
                       type="checkbox"
                       value="all">
                <label>
                <span class="price">
                    {{ __('не важно') }}
                </span>
                </label>
            </div>
    </div>
@endif
