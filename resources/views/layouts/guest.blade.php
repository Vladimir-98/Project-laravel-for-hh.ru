<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sultan_2699') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('/css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/сontenteditable.css') }}">
    <link rel="canonical" href="@yield('canonical', 'sultan_2699')"/>
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
<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
