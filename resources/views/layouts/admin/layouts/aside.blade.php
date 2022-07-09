<aside style="z-index: 7;">
    <div class="aside-panel-admin" id="panelAdmin">
        <div class="gamburger" onclick="getGamburger(this)">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="aside-panel-admin__menu" id="panelAdminMenu">
            <a class="get-index" href="{{ __('/') }}">
                <i class="fa fa-globe" aria-hidden="true"></i>
                <span>{{ __('На сайт') }}</span>
            </a>
            <a href="javascript:void(0)" onclick="getSidebarDropdown(this, '-white')">
                <span class="down-icon" style="background-image: url(&quot;/upload/svg/down-dropdown-white.svg&quot;);"></span>
                <i class="fa fa-window-restore" aria-hidden="true"></i>
                <span>{{ __('Страницы') }}</span>
            </a>
            <div class="nav-link-dropdown" style="display: none;">
                <a href="{{ url('admin/pages/show/1') }}">
                    <span>{{ __('Главная') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/2') }}">
                    <span>{{ __('Готовые проекты') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/3') }}">
                    <span>{{ __('Строящиеся проекты') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/4') }}">
                    <span>{{ __('Квартиры') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/6') }}">
                    <span>{{ __('Рассрочка') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/9') }}">
                    <span>{{ __('Дизайн ') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/5') }}">
                    <span>{{ __('Вопросы') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/7') }}">
                    <span>{{ __('Новости') }}</span>
                </a>
                <a href="{{ url('admin/pages/show/8') }}">
                    <span>{{ __('Соглашение') }}</span>
                </a>
            </div>
            <a class="get-index" href="{{ route('admin.cities') }}">
                <i class="fa fa-map-pin" aria-hidden="true"></i>
                <span>{{ __('Города') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.districts') }}">
                <i class="fa fa-street-view" aria-hidden="true"></i>
                <span>{{ __('Районы') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.projects') }}">
                <i class="fa fa-building" aria-hidden="true"></i>
                <span>{{ __('Проекты') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.apartments') }}">
                <i class="fa fa-address-book" aria-hidden="true"></i>
                <span>{{ __('Квартиры') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.questions') }}">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span>{{ __('Вопрос ответ') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.news') }}">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                <span>{{ __('Новости') }}</span>
            </a>
            <a class="get-index" href="{{ route('admin.reviews') }}">
                @if(session()->get('count.reviews'))
                    <span class="notification">{{ session()->get('count.reviews') }}</span>
                @endif
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <span>{{ __('Отзывы') }}</span>
            </a>
        </div>
    </div>
</aside>

