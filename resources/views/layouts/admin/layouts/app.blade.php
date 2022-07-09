<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Sultan_2669') }}</title>
    <link rel="stylesheet" href="{{ asset('css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css') }}"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/сontenteditable.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <!-- Scripts -->
    {{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
</head>
<body>
<div class="alert-top" style="display: none">
    <div class="alert">
    </div>
</div>

<div class="alert-preload" style="display: none">
    <div class="preload alert-success">
        <img src="{{ asset('upload/preload.gif') }}" alt="preload">
    </div>
</div>
<div class="wrapper admin">
    @include('layouts.admin.layouts.aside')
    @include('layouts.admin.layouts.navigation')
    <div class="main-container content-admin" id="pageContent">
        @yield('admin_content')
        <div id="modalPage"></div>
    </div>
</div>
@stack('scripts')
<script src="{{ asset('/js/admin.js') }}"></script>
<script src="{{ asset('/js/сontenteditable.js') }}"></script>
{{--<script src="{{ asset('/js/main.js') }}"></script>--}}

</body>
</html>
