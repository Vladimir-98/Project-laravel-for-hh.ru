<aside>
    <div class="aside-panel">
        <div class="aside-panel__menu">
            <a href="{{ route('old-projects') }}">
                <img src="{{ asset('/upload/svg/home.svg') }}" alt="home.svg" width="22" height="22px">
                <span>@lang('main.old_projects')</span>
            </a>
            <a href="{{ route('new-projects') }}">
                <img src="{{ asset('/upload/svg/building.svg') }}" alt="building.svg" width="22" height="22px">
                <span>@lang('main.new_projects')</span>
            </a>
            <a href="{{ route('apartments') }}">
                <img src="{{ asset('/upload/svg/flat.svg') }}" alt="flat.svg" width="22" height="22px">
                <span>@lang('main.apartments')</span>
            </a>
            <a href="{{ route('interior-design') }}">
                <img src="{{ asset('/upload/svg/design.svg') }}" alt="design.svg" width="22" height="22px">
                <span>@lang('main.interior_design')</span>
            </a>
            <a href="{{ route('installments') }}">
                <img src="{{ asset('/upload/svg/installments.svg') }}" alt="installments.svg"  width="22" height="22px">
                <span>@lang('main.installments')<br>{{ __(' 0%') }}</span>
            </a>
            <a href="{{ route('questions') }}">
                <img src="{{ asset('/upload/svg/faq.svg') }}" alt="faq.svg" width="22" height="22px">
                <span>@lang('main.questions')</span>
            </a>
            <a href="{{ route('news') }}">
                <img src="{{ asset('/upload/svg/news.svg') }}" alt="news.svg" width="22" height="22px">
                <span>@lang('main.news')</span>
            </a>
        </div>
    </div>
</aside>
