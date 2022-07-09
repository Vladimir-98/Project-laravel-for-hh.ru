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
@section('canonical', url('/'.$lang_canonical.'dashboard'))
@section('data-form', 'Заявка со страницы редактирования данных пользователя.')

<x-guest-layout>
    <div class="page-content-wrapper">
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span class="d-inline-block">{{ ucfirst(__('main.changing_personal_data')) }}</span>
                </div>
            </div>
            <div class="columns dashboard catalog-block" id="catalogData">
                <div class="left">
                    <div class="block" id="boxFilter">
                        <div class="flex-space-b header-block">
                            <h3>{{ ucfirst(__('main.changing_personal_data')) }}</h3>
                        </div>
                        <x-auth-card-dashboard>
                            <x-auth-validation-errors class="auth-errors" :errors="$errors"/>
                            <x-auth-session-status class="auth-session" :status="session('status')"/>
                            <form
                                method="POST"
                                action="{{ route('updateDataUser') }}"
                                enctype="multipart/form-data">
                            @csrf
                                <div class="card-form">
                                    <div class="box-form-group-img">
                                        <div class="form-group-img user_img_box">
                                            <label for="img">
                                                {{ ucfirst(__('auth.avatar')) }}
                                            </label>
                                            <div class="img-box mt-3 mb-3 post" style="width: 50px; height: 50px;
                                                border-radius: 50%;
                                                background:
                                                @if(!empty($user->avatar))
                                                    url(/upload/avatar/{{ $user->avatar }})
                                                @else
                                                    url(/upload/svg/avatar.svg)
                                                @endif
                                                no-repeat center/cover">
                                                <input class="input-img" type="file" name="avatar" onchange="loadImageInput(event, this)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Name -->
                                <div class="form-group">
                                    <x-label for="name" :value="__('auth.name')"/>

                                    <x-input id="name" class="custom_input" type="text" name="name" :value="$user->name" required autofocus/>
                                </div>

                                <div class="form-group">
                                    <x-label for="phone" :value="__('auth.phone_number')"/>

                                    <x-input class="phone custom_input" type="text" name="phone" :value="$user->phone" required autofocus/>
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
        <script src="{{ asset('/js/reverse-file.js') }}"></script>
        <script src="{{ asset('/js/phone-mask.js') }}"></script>
    @endpush
</x-guest-layout>

<style>
    .user_img_box {
        justify-content: left;
    }
    .user_img_box label{
        margin-bottom: 10px;
        font-family: 'Montserrat Regular';
    }
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
