@extends('layouts.admin.layouts.app')
@section('admin_content')
    <div class="container">
        <div class="columns" style="gap: 32px;">
            <div class="left mx-auto" id="modalPage">
                <div class="fake-offset">
                    <input type="hidden" id="currentSortId">
                    <div class="block page-admin-block mb-5" id="componentsPage">
                        @if($page->id === 1)
                            @include('admin.pages.header')
                        @elseif($page->id === 6 || $page->id === 9)
                            @include('admin.pages.about')
                        @elseif($page->id === 8)
                            @include('admin.pages.review')
                        @else
                            @include('admin.pages.title')
                        @endif
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="sidebar">
                    <div class="nav-list">
                        <div class="navigation-box" onclick="getSidebarDropdown(this, 'blue')" style="width: 100%;">
                            <div class="down-icon" style="background-image: url({{ asset('upload/svg/down-dropdown.svg') }});"></div>
                            <a href="javascript:void(0)" class="btn btn-category-dropdown p-0">{{ __('меню контента') }}</a>
                        </div>
                        <div class="navigation-dropdown">
                            <div class="navigation_dropdown_links">
                                @if($page->id === 1)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/header', {{ $page->id }});">{{ __('шапка') }}</a>
                                    </div>
                                @endif
                                @if($page->id != 6 && $page->id !== 8 && $page->id !== 9)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/page-title', {{ $page->id }});">
                                            @if($page->id === 1)
                                                {{ __('заголовки страницы') }}
                                            @else
                                                {{ __('заголовок страницы') }}
                                            @endif
                                        </a>
                                    </div>
                                @endif
                                @if($page->id === 1 || $page->id === 6 || $page->id === 9)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/about', {{ $page->id }});">
                                            @if($page->id === 6)
                                                {{ __('контент') }}
                                            @elseif($page->id === 9)
                                                {{ __('описание услуги') }}
                                            @else
                                                {{ __('блок о нас') }}
                                            @endif
                                        </a>
                                    </div>
                                @endif
                                @if($page->id == 9)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('page-slider', {{ $page->id }});">
                                            {{ __('слайдер') }}
                                        </a>
                                    </div>
                                @endif
                                @if($page->id === 1 || $page->id == 8 || $page->id == 9)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/review', {{ $page->id }});">
                                            @if($page->id == 1)
                                                {{ __('блок отзывов') }}
                                            @elseif($page->id == 8)
                                                {{ __('соглашение') }}
                                            @elseif($page->id == 9)
                                                {{ __('описание') }}
                                            @endif
                                        </a>
                                    </div>
                                @endif
                                @if($page->id == 9)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('video', {{ $page->id }});">
                                            {{ __('видео') }}
                                        </a>
                                    </div>
                                @endif
                                @if($page->id === 1)
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/design', {{ $page->id }});">{{ __('блок дизайн') }}</a>
                                    </div>
                                    <div class="nav-link p-0">
                                        <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/map', {{ $page->id }});">{{ __('карта') }}</a>
                                    </div>
                                @endif
                                <div class="nav-link p-0">
                                    <a href="javascript:void(0)" onclick="addComponents('/admin/pages/show/meta', {{ $page->id }});">{{ __('мета теги') }}</a>
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
                    <input type="hidden" name="page_id" id="deletePageComponentId" value="{{ $page->id }}">
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
@endsection
@push('scripts')
    <script src="{{ asset('/js/images-slider.js') }}"></script>
@endpush
