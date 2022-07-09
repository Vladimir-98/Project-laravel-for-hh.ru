@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp

@section('title_meta', Lang::get('main.selected_projects'))
@section('description_meta', strip_tags(str_replace("\xC2\xA0", " ", Lang::get('main.selected_projects_description'))))
@section('canonical', url('/'.$lang_canonical.'added-projects'))
@section('data-form', 'Заявка со страницы избранных проектов.')

<x-app-layout>
    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container catalog-apartments">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span>{{ ucfirst(__('main.added_projects')) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block project-page">
                        <div id="catalogData">
                            @if($projects)
                                <div class="flex-space-b header-block">
                                    <h1>
                                        {{ ucfirst(__('main.added_projects')) }}
                                    </h1>
                                </div>
                                <div class="filter-cards">
                                    <div class="card-grid-two" id="addedData">
                                        @foreach($projects as $project)
                                            <div class="swiper-slide">
                                                @php
                                                    $urls_arr = [
                                                        'url_en' => $project->id.' residential complex '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' turkey',
                                                        'url_tr' => $project->id.' konut kompleksi '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' türkiye',
                                                        'url_ru' => $project->id.' жилой комплекс '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' турция',
                                                    ];
                                                @endphp
                                                <div class="card" style="max-width: 100%">
                                                    <span class="title_card_name">{{ $project['name_'.$lang] }}</span>
                                                    <a class="right-link" title="{{ $urls_arr['url_'.$lang] }}" target="_blank" href="{{ asset(''.$url_lang.'/projects/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}"></a>
                                                    <div class="card-img">
                                                        <img
                                                            src="@if($project->images->catalog){{ asset('upload/projects/catalog') }}/{{ $project->images['catalog'.$agent] }}@else{{ asset('/upload/default_project_catalog.jpg') }}@endif"
                                                            title="{{ $project->images->catalog_alt }}"
                                                            alt="{{ $project->images->catalog_alt }}"
                                                            width="410" height="252">
                                                        <div class="heart">
                                                            <img data-name="Project" data-id="{{ $project->id }}"
                                                                 @if(session()->has('data.projects') && in_array($project->id, session()->get('data.projects')))
                                                                 src="{{ asset('upload/svg/heart-red.svg') }}" alt="heart-red" width="30" height="30"
                                                                 @else
                                                                 src="{{ asset('upload/svg/heart-white.svg') }}" alt="heart-white" width="30" height="30"
                                                                @endif
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="logo-box">
                                                        <img
                                                            src="@if($project->images->post){{ asset('upload/projects/logo') }}/{{ $project->images->logo }}@else{{ asset('/upload/default_project_logo.png') }}@endif"
                                                            title="{{ $project->images->logo_alt }}"
                                                            alt="{{ $project->images->logo_alt }}"
                                                            width="80px" height="60px">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="pagination-area">
                                            @if($projects_length)
                                                <div  class="pagination-show">
                                                    <div data-name="{{ route('cartsProjects') }}" data-id="{{ $page }}" class="pagination-page">@lang('main.show_more')</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="flex-space-b header-block">
                                    <h4>{{ ucfirst(__('main.nothing_projects')) }}</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar" id="boxFilter">
                        @include('layouts.added-sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid"></div>
{{--    @push('scripts')--}}
{{--        <script src="{{ asset('/js/filter.js') }}"></script>--}}
{{--    @endpush--}}
</x-app-layout>



