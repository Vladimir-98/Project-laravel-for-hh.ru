@include('layouts.search')
<div class="nav-list">
    <x-leave-request/>
    <div class="navigation-box" onclick="getSidebarDropdown(this, '')">
        <div class="down-icon"
             style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
        @if (isset($projects) || isset($apartments))
            <div class="btn btn-category-dropdown dropdown_link">@lang('main.filter')</div>
        @else
            <div class="btn btn-category-dropdown dropdown_link">
                @if(isset($questions) || isset($question))
                    @lang('main.popular')
                @elseif(isset($news) || isset($one_news))
                    @lang('main.last')
                @endif
            </div>
        @endif
    </div>
    <div class="navigation-dropdown filter">
        <div class="navigation_dropdown_links">
            @if(isset($projects) || isset($apartments))
                <form action="{{ route('get-filter') }}" method="GET" enctype="multipart/form-data" id="getFilterForm">
                    @isset($operator)
                        <input type="hidden" class="checked" name="operator" value="{{ $operator }}">
                    @endisset
                        <input type="hidden" name="page_id" class="checked" value="{{ $page->id }}">
                        @csrf
                        <input type="hidden" class="checked" name="price" id="priceFilter" value="{{ $desc_price }}">
                        <input type="hidden" class="checked" name="id" id="idFilter" value="{{ $desc_id }}">
                    <!================== CITIES ===================>
                    @if (!empty($cities))
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon"
                                 style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.city')</div>
                        </div>
                        <div class="nav-link-dropdown">
                            @foreach($cities as $key => $city)
                                <div class="checkbox">
                                        <input class="custom-checkbox one-checked"
                                               type="checkbox"
                                               name="city_id"
                                               value="{{ $city->id }}">
                                    <label>
                                <span class="price">
                                    {{ $city['name_'.$lang] }}
                                </span>
                                    </label>
                                </div>
                            @endforeach
                                <div class="checkbox">
                                    <input class="custom-checkbox one-checked"
                                           type="checkbox"
                                           name="city_id"
                                           value="all">
                                    <label>
                                <span class="price">
                                    @lang('main.doesnt_matter')
                                </span>
                                    </label>
                                </div>
                        </div>
                    @endif

                    <!=================== DISTRICTS ====================>

                    <div id="filterDistrict" style="display:@if(!empty($districts)){{ __('block') }}@else{{ __('none') }}@endif">
                        @include('layouts.filter-district')
                    </div>

                    <!====================== SEA ========================>
                    <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                        <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                        <div class="dropdown_link">@lang('main.sea')</div>
                    </div>

                    <div class="nav-link-dropdown">
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="sea-1" name="sea" value="1">
                            <label>
                                <span class="price">{{ __('0') }}</span>
                                <span class="down-icon" style="background-image: url({{ asset('/upload/svg/right-pagination.svg') }});"></span>
                                <span class="price">{{ __('500 м') }}</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="sea-2" name="sea" value="500">
                            <label>
                                <span class="price">{{ __('500 м') }}</span>
                                <span class="down-icon" style="background-image: url({{ asset('/upload/svg/right-pagination.svg') }});"></span>
                                <span class="price">{{ __('1000 м') }}</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="sea-3" name="sea" value="1000">
                            <label>
                                <span class="price" style="width: 113px">@lang('main.farther'){{ __(' 1000 м') }}</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="sea-3" name="sea" value="9000">
                            <label>
                                <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                            </label>
                        </div>
                    </div>

                    <!====================== GAS ========================>
                    <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                        <div class="down-icon"
                             style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                        <div class="dropdown_link">@lang('main.gas')</div>
                    </div>

                    <div class="nav-link-dropdown">
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="gas-1" name="gas" value="1">
                            <label >
                                <span class="price">@lang('main.yes')</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="gas-2" name="gas" value="2">
                            <label>
                                <span class="price">@lang('main.no')</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <input class="custom-checkbox one-checked" type="checkbox" id="gas-3" name="gas" value="all">
                            <label>
                                <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                            </label>
                        </div>
                    </div>

                    @isset($projects)
                        <!====================== PROJECTS ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.availability_apartments')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="availability-1" name="availability" value="1">
                                <label>
                                    <span class="price">@lang('main.yes')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="availability-2" name="availability" value="2">
                                <label>
                                    <span class="price">@lang('main.no')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="availability-3" name="availability" value="all">
                                <label>
                                    <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                                </label>
                            </div>
                        </div>
                    @endisset
                    @isset($apartments)
                        <!====================== APARTMENTS ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.quadrature')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <div class="filter_number">
                                    <button class="btn click_number_filter" type="button" data-id="quadrature">+</button>
                                    <label>
                                        <input class="custom_input checked" type="number" name="quadrature" placeholder="{{ __('-') }}" value="" id="quadrature">
                                    </label>
                                    <button class="btn click_number_filter" type="button" data-id="quadrature">-</button>
                                </div>
                            </div>
                        </div>

                        <!====================== STATUS ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.sale_status')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="status-2" name="status" value="1">
                                <label>
                                    <span class="price">@lang('main.urgent_sale')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="status-3" name="status" value="all">
                                <label>
                                    <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                                </label>
                            </div>
                        </div>

                        <!====================== FLOOR ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.floor')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <div class="filter_number">
                                    <button class="btn click_number_filter" type="button" data-id="floor">+</button>
                                    <label>
                                        <input class="custom_input checked" type="number" name="floor" placeholder="{{ __('-') }}" value="" id="floor">
                                    </label>
                                    <button class="btn click_number_filter" type="button" data-id="floor">-</button>
                                </div>
                            </div>
                        </div>

                        <!====================== LAYOUTS ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon"
                                 style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.layouts')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="1">
                                <label>
                                    <span class="price">{{ __('1 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="2">
                                <label>
                                    <span class="price">{{ __('2 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="3">
                                <label>
                                    <span class="price">{{ __('3 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="4">
                                <label>
                                    <span class="price">{{ __('4 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="5">
                                <label>
                                    <span class="price">{{ __('5 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-2" name="layout" value="6">
                                <label>
                                    <span class="price">{{ __('6 + 1') }}</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="layout-3" name="layout" value="all">
                                <label>
                                    <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                                </label>
                            </div>
                        </div>

                        <!====================== KITCHEN ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.kitchen')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="kitchen-1" name="kitchen" value="1">
                                <label>
                                    <span class="price">@lang('main.combined')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="kitchen-2" name="kitchen" value="2">
                                <label>
                                    <span class="price">@lang('main.separate')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="kitchen-3" name="kitchen" value="all">
                                <label>
                                    <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                                </label>
                            </div>
                        </div>

                        <!====================== BALCONY ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.balcony')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <div class="filter_number">
                                    <button class="btn click_number_filter" type="button" data-id="balcony">+</button>
                                    <label>
                                        <input class="custom_input checked" type="number" name="balcony" placeholder="{{ __('-') }}" value="" id="balcony">
                                    </label>
                                    <button class="btn click_number_filter" type="button" data-id="balcony">-</button>
                                </div>
                            </div>
                        </div>

                        <!====================== BATHROOM ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.bathroom')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <div class="filter_number">
                                    <button class="btn click_number_filter" type="button" data-id="bathroom">+</button>
                                    <label>
                                        <input class="custom_input checked" type="number" name="bathroom" placeholder="{{ __('-') }}" value="" id="bathroom">
                                    </label>
                                    <button class="btn click_number_filter" type="button" data-id="bathroom">-</button>
                                </div>
                            </div>
                        </div>

                        <!====================== BEDROOM ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.bedroom')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <div class="filter_number">
                                    <button class="btn click_number_filter" type="button" data-id="bedroom">+</button>
                                    <label>
                                        <input class="custom_input checked" type="number" name="bedroom" placeholder="{{ __('-') }}" value="" id="bedroom">
                                    </label>
                                    <button class="btn click_number_filter" type="button" data-id="bedroom">-</button>
                                </div>
                            </div>
                        </div>

                        <!====================== FURNITURE ========================>
                        <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                            <div class="dropdown_link">@lang('main.furniture')</div>
                        </div>

                        <div class="nav-link-dropdown">
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="furniture-1" name="furniture" value="1">
                                <label>
                                    <span class="price">@lang('main.yes')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="furniture-2" name="furniture" value="2">
                                <label>
                                    <span class="price">@lang('main.no')</span>
                                </label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox one-checked" type="checkbox" id="furniture-3" name="furniture" value="all">
                                <label>
                                    <span class="price" style="width: 113px">@lang('main.doesnt_matter')</span>
                                </label>
                            </div>
                        </div>
                    @endisset

                    <!====================== INFRASTRUCTURE ========================>
                    <div class="nav-link" onclick="getSidebarDropdown(this, '')">
                        <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                        <div class="dropdown_link">@lang('main.infrastructure')</div>
                    </div>

                    <div class="nav-link-dropdown">
                        @isset($projects)
                            <div class="checkbox">
                                <input class="custom-checkbox several-checked" type="checkbox" id="installments" name="installments" value="1">
                                <label>
                                    <span class="price">@lang('main.installments')</span>
                                </label>
                            </div>
                        @endisset
                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="pool" name="pool" value="1">
                            <label>
                                <span class="price">@lang('main.pool')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="sauna" name="sauna" value="1">
                            <label>
                                <span class="price">@lang('main.sauna')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="hammam" name="hammam" value="1">
                            <label>
                                <span class="price">@lang('main.hammam')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="fitness" name="fitness" value="1">
                            <label>
                                <span class="price">@lang('main.fitness_room')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="relaxation" name="relaxation" value="1">
                            <label>
                                <span class="price">@lang('main.recreation')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="barbecue" name="barbecue" value="1">
                            <label>
                                <span class="price">@lang('main.area_barbecue')</span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <input class="custom-checkbox several-checked" type="checkbox" id="sport" name="sport" value="1">
                            <label>
                                <span class="price">@lang('main.area_sports_ground')</span>
                            </label>
                        </div>
                    </div>
                </form>
            @else
                <div class="nav-link">
                    @foreach($populars as $popular)
                        <div class="d-flex">
                            <h6>{{ $popular['title_'.$lang] }}</h6>
                            @if(isset($news) || isset($one_news))
                                <a href="{{ url('news/'.$popular->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($popular['title_'.$lang], $translate)) ) ) }}" class="right-icon"></a>
                            @elseif(isset($questions) || isset($question))
                                <a href="{{ url('questions/'.$popular->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($popular['title_'.$lang], $translate)) ) ) }}" class="right-icon"></a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

