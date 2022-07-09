@php
    $back_route = Route::currentRouteName();

    if (
        $back_route == 'one-news' ||
        $back_route == 'question' ||
        $back_route == 'apartment' ||
        $back_route == 'old-project' ||
        $back_route == 'project' ||
        $back_route == 'new-project' ||
        $back_route == 'password.expired' ||
        $back_route == 'user.update' ||
        $back_route == 'cartsProjects' ||
        $back_route == 'cartsApartments'
        ){
        $url_array = explode( '/', url()->current());
        $back_route = $url_array[count($url_array) - 2].'/'.$url_array[count($url_array) - 1];
    }

    if ($back_route == 'password.request') {
        $back_route = 'forgot-password';
    }

    session()->has('data.projects') ? $quantity_projects = count( session()->get('data.projects')) : $quantity_projects = 0;
    session()->has('data.apartments') ? $quantity_apartments = count( session()->get('data.apartments')) : $quantity_apartments = 0;
    $quantity = $quantity_projects + $quantity_apartments;

@endphp

<header>
    <div class="header">
        <div class="header-desk">
            <div class="d-flex">
                <div class="header-left">
                    <div class="logo">
                        <x-application-logo></x-application-logo>
                    </div>
                    <div class="box-lang" onclick="getProfileDropDown(this)">
                        <div class="menu-dropdown">
                            <div class="link">
                                <a href="{{ asset('/') }}{{ $back_route }}">{{ __('ru') }}</a>
                            </div>
                            <div class="link">
                                <a href="{{ asset('en') .'/' }}{{ $back_route }}">{{ __('en') }}</a>
                            </div>
                            <div class="link">
                                <a href="{{ asset('tr') .'/' }}{{ $back_route }}">{{ __('tr') }}</a>
                            </div>
                        </div>
                        <div class="lang-text">{{ app()->getLocale() }}</div>
                        <div class="down-icon"
                             style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                    </div>
                </div>
                <div class="header-center">
                    <div class="header-menu">

                        <ul>
                            <li>
                                <a href="/">{{ __('+90 531 270 9650') }}</a>
                            </li>
                            <li>
                                <a href="/">{{ __('+90 531 270 9650') }}</a>
                            </li>
                            <li>
                                <a href="/">{{ __('admin@gmail.com') }}</a>
                            </li>
                            <li>
                                <a href="/">@lang('main.country_name') - @lang('main.city_name')</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-right">
                    <div class="profile-panel">
                        <div class="box">
                            <a href="{{ route('cartsProjects') }}">
                                <img src="{{ asset('upload/svg/heart.svg') }}" alt="heart" width="30" height="30">
                            </a>
                            <span @if($quantity == 0) style="display: none" @endif id="countCart">{{ $quantity }}</span>
                        </div>
                        <div class="box" data-name="avatar" onclick="getProfileDropDown(this)" style="background: @if(!empty(Auth::user()->avatar)) url({{ asset('upload/avatar') }}{{ __('/') }}{{ Auth::user()->avatar }}) @else url({{ asset('upload/svg/avatar.svg') }}) @endif no-repeat center/cover" >
                            @auth
                                <div class="menu-dropdown">
                                    <div class="link">
                                        <a href="{{ route('user.update') }}">@lang('auth.account')</a>
                                    </div>
                                    @if(Auth::check() && Auth::user()->isAdmin())
                                        <div class="link">
                                            <a href="{{ url('/admin/pages/show/1') }}">@lang('main.admin_panel')</a></li>
                                        </div>
                                    @endif
                                    <div class="link">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">@lang('auth.logout')</a>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="menu-dropdown">
                                    <div class="link">
                                        <a href="{{ route('login') }}">@lang('auth.login')</a>
                                    </div>
                                    <div class="link">
                                        <a href="{{ route('register') }}">@lang('auth.register')</a></li>
                                    </div>
                                </div>
{{--                                <span class="title">@lang('auth.login')</span>--}}
                            @endauth

{{--                            <div class="down-icon" style=" background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{--<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">--}}
{{--    <!-- Primary Navigation Menu -->--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600"/>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Navigation Links -->--}}
{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}
{{--            </div>--}}

<!-- Settings Dropdown -->
{{--            <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
{{--                <x-dropdown align="right" width="48">--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <button--}}
{{--                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                            <div>{{ Auth::user()->name }}</div>--}}

{{--                            <div class="ml-1">--}}
{{--                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                     viewBox="0 0 20 20">--}}
{{--                                    <path fill-rule="evenodd"--}}
{{--                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"--}}
{{--                                          clip-rule="evenodd"/>--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}

{{--                    <x-slot name="content">--}}
{{--                        <!-- Authentication -->--}}
{{--                        <form method="POST" action="{{ route('logout') }}">--}}
{{--                            @csrf--}}

{{--                            <x-dropdown-link :href="route('logout')"--}}
{{--                                             onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                {{ __('Log Out') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                        </form>--}}
{{--                    </x-slot>--}}
{{--                </x-dropdown>--}}
{{--            </div>--}}

<!-- Hamburger -->
{{--            <div class="-mr-2 flex items-center sm:hidden">--}}
{{--                <button @click="open = ! open"--}}
{{--                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"--}}
{{--                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M4 6h16M4 12h16M4 18h16"/>--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"--}}
{{--                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

<!-- Responsive Navigation Menu -->
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-responsive-nav-link>--}}
{{--        </div>--}}

<!-- Responsive Settings Options -->
{{--        <div class="pt-4 pb-1 border-t border-gray-200">--}}
{{--            <div class="px-4">--}}
{{--                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>--}}
{{--                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
{{--            </div>--}}

{{--            <div class="mt-3 space-y-1">--}}
<!-- Authentication -->
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}

{{--                    <x-responsive-nav-link :href="route('logout')"--}}
{{--                                           onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                        {{ __('Log Out') }}--}}
{{--                    </x-responsive-nav-link>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
