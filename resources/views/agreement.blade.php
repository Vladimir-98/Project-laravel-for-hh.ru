@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = '/'; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';

@endphp

@if(!empty($page->meta['title_meta_' . $lang]))
    @section('title_meta', htmlspecialchars($page->meta['title_meta_' . $lang]))
@endif
@if(!empty($page->meta['description_meta_' . $lang]))
    @section('description_meta', strip_tags(str_replace("\xC2\xA0", " ", $page->meta['description_meta_' . $lang])))
@endif
@section('canonical', url('/'.$lang_canonical.'agreement'))
@section('data-form', 'Заявка со страницы пользовательского соглашение.')

<x-app-layout>
    <div class="page-content-wrapper " style="margin-bottom: 32px">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span>{{ ucfirst(__('main.agreement')) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block">
                        @if(empty($page->review['title_review_'.$lang]) && empty($page->review['description_review_'.$lang]))
                            <div class="flex-space-b header-block">
                                <h3>@lang('main.nothing_found')</h3>
                            </div>
                        @else
                            <div class="flex-space-b header-block">
                                <h1>{{ ucfirst($page->review['title_review_'.$lang]) }}</h1>
                            </div>
                            <div class="img-text-block">
                                <p class="text-paragraph">
                                    {!! $page->review['description_review_'.$lang] !!}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar" id="boxFilter">
                        @include('layouts.search')
                        <div class="nav-list">
                            <x-leave-request/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



