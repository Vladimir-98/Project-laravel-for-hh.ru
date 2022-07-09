<div class="fix-mobile-menu">
    <div class="fix-menu-toggle" onclick="getConnectionMenu();">
        <span>{{ __('Контакты') }}</span>
        <!--            <img src="/upload/svg/connection.svg" alt="">-->
    </div>
    <div id="fixBoxConnection" class="fix-menu-list">
        <div class="box-connection">
            <a href="/">
                <img src="{{ asset('/upload/svg/whatsapp.svg') }}" alt="whatsapp.svg" width="23" height="23">
            </a>
            <a href="/">
                <img src="{{ asset('/upload/svg/instagram.svg') }}" alt="instagram.svg" width="23" height="23">
            </a>
            <a href="/">
                <img src="{{ asset('/upload/svg/youtube.svg') }}" alt="youtube.svg" width="23" height="23">
            </a>
            <a href="/">
                <img src="{{ asset('/upload/svg/mail.svg') }}" alt="mail.svg" width="23" height="23">
            </a>
            <a href="/">
                <span>{{ __('1') }}</span>
                <img src="{{ asset('/upload/svg/phone.svg') }}" alt="phone.svg" width="23" height="23">
            </a>
            <a href="/">
                <span>{{ __('2') }}</span>
                <img src="{{ asset('/upload/svg/phone.svg') }}" alt="phone.svg" width="23" height="23">
            </a>
        </div>
    </div>
</div>
