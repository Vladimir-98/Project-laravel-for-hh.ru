@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = '/'; }
@endphp
<a href="{{ $url_lang }}">
    <img src="{{ asset('/upload/svg/logo-blue.svg') }}" alt="logo sultan_2669" width="80" height="50">
</a>
