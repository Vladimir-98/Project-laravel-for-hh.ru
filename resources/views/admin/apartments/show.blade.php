@extends('layouts.admin.layouts.app')
@section('admin_content')
    <div class="container">
        <div class="columns" style="gap: 32px;">
            <div class="left mx-auto" id="modalPage">
                <div class="fake-offset">
                    <div class="block page-admin-block mb-5" id="componentsPage">
                        @include('admin.apartments.components.swiper', $apartment)
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="sidebar">
                    <div class="nav-list">
                        <div class="navigation-box" onclick="getSidebarDropdown(this, 'blue')" style="width: 100%;">
                            <div class="down-icon" style="background-image: url({{ asset('upload/svg/down-dropdown.svg') }});"></div>
                            <a href="javascript:void(0)"
                               class="btn btn-category-dropdown p-0">{{ __('меню контента') }}</a>
                        </div>
                        <div class="navigation-dropdown">
                            <div class="navigation_dropdown_links">
{{--                                <div class="nav-link p-0">--}}
{{--                                    <a href="javascript:void(0)" onclick="addComponents('/admin/apartments/show/meta', {{ $apartment->id }});">{{ __('мета теги') }}</a>--}}
{{--                                </div>--}}
                                <div class="nav-link p-0">
                                    <a href="javascript:void(0)" onclick="addComponents('/admin/apartments/show/slider', {{ $apartment->id }});">{{ __('слайдер') }}</a>
                                </div>
                                <div class="nav-link p-0">
                                    <a href="javascript:void(0)" onclick="addComponents('/admin/apartments/show/description', {{ $apartment->id }});">{{ __('описание') }}</a>
                                </div>
                                <div class="nav-link p-0">
                                    <a href="javascript:void(0)" onclick="addComponents('/admin/apartments/show/video', {{ $apartment->id }});">{{ __('видео') }}</a>
                                </div>
                                <div class="nav-link p-0">
                                    <a href="javascript:void(0)" onclick="addComponents('/admin/apartments/show/map', {{ $apartment->id }});">{{ __('карта') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_modal" class="modal" style="display: none; z-index: 7;">
        <div class="modal_content container">
            <span class="close_modal_window close_modal_delete">{{ __('×') }}</span>
            <div class="card-form">
                <form id="deleteForm" action="" method="POST">
                    <input type="hidden" name="page_id" id="deletePageComponentId" value="{{ $apartment->id }}">
                    <input type="hidden" name="id" value="" id="idComponent">
                    @csrf
                    <h3>{{ __('Вы уверенны?') }}</h3>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal_delete">
                                {{ __('отмена') }}
                            </button>
                            <button type="button" class="btn btn-danger btn_delete_component">
                                {{ __('удалить') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('/js/images-slider.js') }}"></script>
    @endpush
@endsection
