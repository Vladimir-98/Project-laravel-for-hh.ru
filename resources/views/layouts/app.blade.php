<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<?php $lang = app()->getLocale(); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width,  initial-scale=1.0, maximum-scale=6.0, minimum-scale=1.0">
{{--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title_meta', 'sultan_2699')</title>
    <meta name="description" content="@yield('description_meta', 'sultan_2699')">
    <link rel="canonical" href="@yield('canonical', 'sultan_2699')"/>

{{--    <title>{{ $page->meta['title_meta_'].$lang }}{{ config('app.name', 'Laravel') }}</title>--}}

<!-- Styles -->
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/swiper@8/swiper-bundle.min.css') }}"/>
{{--    <link rel="stylesheet" href="{{ asset('/css/swiper.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <!-- Scripts -->
</head>
<body>

<div class="wrapper">
    @include('layouts.contact-icons')
    @include('layouts.fix-mobile-menu')
    @include('layouts.aside')
    @include('layouts.navigation')
    <div class="main-container">
        {{ $slot }}
    </div>
    @include('layouts.footer')
    @include('layouts.agreement-modal')
    @include('layouts.modal-form')
</div>
@stack('scripts')
<script src="{{ asset('https://unpkg.com/swiper@8/swiper-bundle.min.js') }}"></script>
{{--<script src="{{ asset('/js/swiper.js') }}"></script>--}}
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/phone-mask.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/css/normalize.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/сontenteditable.css') }}">
</body>
</html>
