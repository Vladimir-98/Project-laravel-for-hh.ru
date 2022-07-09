<?php
$lang = app()->getLocale();

$url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }

?>
@include('layouts.search')
<div class="nav-list">
    <x-leave-request/>
    <div class="navigation-box" style="width: 100%" onclick="getSidebarDropdown(this, 'blue')">
        <div class="down-icon" style="background-image: url({{ asset('upload/svg/down-dropdown.svg') }});"></div>
        <a href="javascript:void(0)" class="btn btn-category-dropdown">@lang('main.personal_account')</a>
    </div>
    <div class="navigation-dropdown">
        <div class="navigation_dropdown_links">
            <div class="nav-link">
                <a href="{{ route('user.update') }}">@lang('main.data')</a>
            </div>
            <div class="nav-link">
                <a href="{{ route('password.expired') }}">@lang('auth.password_name')</a>
            </div>
        </div>
    </div>
</div>


