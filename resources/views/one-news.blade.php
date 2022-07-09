@php
$lang = app()->getLocale();
$lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
$url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }

@endphp

@section('title_meta', $title_arr['title_'.$lang])
@section('description_meta', $description['description_'.$lang])
@section('canonical', url(''.$url_lang.'/news/'.$one_news->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($one_news['title_ru'], $translate)) ) ) )
@section('data-form', 'Заявка со страницы новости "'.$one_news->title_ru.'".')

<x-app-layout>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <a href="{{ route('news') }}">{{ ucfirst(__('main.news')) }}</a>
                    <span>{!! $one_news['title_'.$lang] !!}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block news project-page">
                        <div class="flex-space-b header-block">
                            <h1>{!! $one_news['title_'.$lang] !!}</h1>
                        </div>
                        <div class="project-text-block">
                            <div class="img-text-block">
                                <p class="text-paragraph">
                                    <img class="one-news-img"
                                        src="@if($one_news->images->post){{ asset('upload/news') }}/{{ $one_news->images->post }}@else{{ asset('/upload/default_project_catalog.jpg') }}@endif"
                                        title="{{$one_news->images->post_alt}}" alt="{{$one_news->images->post_alt}}"
                                        >
                                    {!! $one_news['description_'.$lang] !!}
                                </p>
                            </div>
                        </div>
                        @if($one_news->images->youtube)
                            <div class="project-content">
                                <div class="project-text-block">
                                    <div class="video-area">
                                        <div class="video-box">
                                            <iframe src="{{ $one_news->images->youtube }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar" id="boxFilter">
                        @include('layouts.sidebar', [$populars, $one_news])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



