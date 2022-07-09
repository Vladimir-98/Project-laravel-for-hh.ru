@php
    $lang = str_replace('_', '-', app()->getLocale());
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = '/'; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp

@section('title_meta', Lang::get('main.search').' - '.$search)
@section('description_meta', Lang::get('main.search_data').' - '.$search)
@section('canonical', url('/'.$lang_canonical.'search-projects'))

@section('data-form', 'Заявка со страницы поиска.')

<x-app-layout>
    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span class="d-inline-block">{{ ucfirst(__('main.new-projects_row')) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block project-page">
                        <div id="catalogData">
                            @php
                                $lang = app()->getLocale();
                                $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
                            @endphp

                            @if( count($projects) != 0 )
                                <div class="flex-space-b header-block">
                                    <h1>
                                        @if($lang == 'tr')
                                            {{ __('"') }}{{ $search }}{{ __('"') }} @lang('main.search_data')
                                        @else
                                            @lang('main.search_data') {{ __('"') }}{{ $search }}{{ __('"') }}
                                        @endif
                                    </h1>
                                </div>
                                <div class="catalog-cards">
                                    <div class="card-grid-two">
                                        @foreach($projects as $project)
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
                                                        src="@if($project->images->post){{ asset('upload/projects/catalog') }}/{{ $project->images->catalog }}@else{{ asset('/upload/default_project_post.jpg') }}@endif"
                                                        title="{{ $project->images->post_alt }}"
                                                        alt="{{ $project->images->post_alt }}"
                                                        width="240" height="240">
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
                                        @endforeach
                                    </div>
                                </div>
                            @else
                            <div class="flex-space-b header-block">
                                <h3>{{ ucfirst(__('main.nothing_found')) }}</h3>
                            </div>
                            @endif

                        </div>
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
    <div class="container-fluid"></div>
</x-app-layout>



