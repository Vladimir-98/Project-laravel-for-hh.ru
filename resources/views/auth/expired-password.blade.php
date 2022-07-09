@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp

@if(!empty($page->meta['title_meta_' . $lang]))
    @section('title_meta', htmlspecialchars($page->meta['title_meta_' . $lang]))
@endif
@if(!empty($page->meta['description_meta_' . $lang]))
    @section('description_meta', strip_tags(str_replace("\xC2\xA0", " ", $page->meta['description_meta_' . $lang])))
@endif
@section('canonical', url('/'.$lang_canonical.'password/expired'))
@section('data-form', 'Заявка со страницы редактирования пароля пользователя.')

<x-guest-layout>
    <div class="page-content-wrapper">
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span class="d-inline-block">{{ ucfirst(__('main.changing_the_password')) }}</span>
                </div>
            </div>
            <div class="columns dashboard catalog-block" id="catalogData">
                <div class="left">
                    <div class="block" id="boxFilter">
                        <div class="flex-space-b header-block">
                            <h3>{{ ucfirst(__('main.changing_the_password')) }}</h3>
                        </div>
                        <x-auth-card-dashboard>
                            <x-auth-validation-errors class="auth-errors" :errors="$errors"/>
                            <x-auth-session-status class="auth-session" :status="session('status')"/>
                            <form method="POST" action="{{ route('password.postExpired') }}">
                            @csrf
                                <div class="form-group">
                                    <x-label for="password" :value="__('auth.current_password')"/>

                                    <x-input id="password"
                                             class="custom_input"
                                             type="password"
                                             name="current_password"
                                             required autocomplete="current_password"/>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <x-label for="password" :value="__('auth.password_name')"/>

                                    <x-input id="password"
                                             class="custom_input"
                                             type="password"
                                             name="password"
                                             required autocomplete="new-password"/>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <x-label for="password_confirmation" :value="__('auth.confirm_password')"/>

                                    <x-input id="password_confirmation"
                                             class="custom_input"
                                             type="password"
                                             name="password_confirmation" required/>
                                </div>

                                <div class="d-flex">
                                    <x-button class="btn btn-blue">
                                        @lang('main.change')
                                    </x-button>
                                </div>
                            </form>
                        </x-auth-card-dashboard>
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar">
                        @include('layouts.sidebar-account')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid"></div>
    @push('scripts')
        <script src="{{ asset('/js/filter.js') }}"></script>
    @endpush
</x-guest-layout>

<style>
    .card-auth {
        width: 100%;
        margin: 0;
    }

    .card-auth .form {
        width: 100%;
        margin: 0 auto;
        padding: 0 32px 32px 32px;
    }
</style>
