<?php
$lang = app()->getLocale();

$url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }

?>
@include('layouts.search')
<div class="nav-list">
    <x-leave-request/>
    <div class="navigation-box" onclick="getSidebarDropdown(this, '')">
        <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
        <div class="btn btn-category-dropdown">
            @lang('main.favourites')
        </div>
    </div>
    <div class="navigation-dropdown">
        <div class="navigation_dropdown_links">
            <div class="nav-link">
                <a href="{{ route('cartsProjects') }}">@lang('main.project')</a>
            </div>
            <div class="nav-link">
                <a href="{{ route('cartsApartments') }}">@lang('main.apartments')</a>
            </div>
        </div>
    </div>
</div>


