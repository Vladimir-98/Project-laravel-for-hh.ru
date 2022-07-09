@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = '/'; }
@endphp
<footer>
    <div class="footer">
        <div class="flex-space-b">
            <div class="left">
                <p>{{ __('Sultan2669.com All rights reserved.') }}</p>
            </div>
            <div class="logo">
                <a href="{{ asset('/upload/svg/logo-blue.svg') }}">
                    <img src="{{ asset('/upload/svg/logo-blue.svg') }}" alt="logo">
                </a>
            </div>
            <div class="right">{{ __('Copyright© 2021') }}</div>
        </div>
    </div>
</footer>
