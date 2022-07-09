@php
$lang = app()->getLocale();
$lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
$url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = '/'; }
@endphp

@section('title_meta', $title_arr['title_'.$lang])
@section('description_meta', $description['description_'.$lang])
@section('canonical', url(''.$url_lang.'/questions/'.$question->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($question['title_ru'], $translate)) ) ) )
@section('data-form', 'Заявка со страницы вопроса "'.$question->title_ru.'".')


<x-app-layout>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <a href="{{ route('questions') }}">{{ ucfirst(__('main.questions')) }}</a>
                    <span>{!! $question['title_'.$lang] !!}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block">
                        <div class="block">
                            <div class="flex-space-b header-block">
                                <h1>{!! $question['title_'.$lang] !!}</h1>
                            </div>
                            <div class="img-text-block">
                                <p class="text-paragraph">
                                    {!! $question['description_'.$lang] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar" id="boxFilter">
                        @include('layouts.sidebar', [$populars, $question])
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    @push('scripts')--}}
{{--        <script src="{{ asset('/js/filter.js') }}"></script>--}}
{{--    @endpush--}}
</x-app-layout>



