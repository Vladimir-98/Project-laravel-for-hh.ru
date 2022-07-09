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

<x-guest-layout>
    <div class="page-content-wrapper">
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span class="d-inline-block">{{ ucfirst(__('main.added_projects')) }}</span>
                </div>
            </div>
            <div class="columns dashboard catalog-block" id="catalogData">
                <div class="left">
                    @if(count($new_projects) != 0)
                        <div class="block" id="boxFilter">
                            <div class="flex-space-b header-block">
                                @if(!empty($page->title['page_title_one_'.$lang]))
                                    <h3>{{ __('Добавленные проекты') }}</h3>
                                @endif
                            </div>
                            <div class="projects-cards">
                                <div class="card-grid-trio">
                                @foreach($new_projects as $project)
                                    @php
                                        $urls_arr = [
                                            'url_en' => $project->id.' residential complex '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' turkey',
                                            'url_tr' => $project->id.' konut kompleksi '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' türkiye',
                                            'url_ru' => $project->id.' жилой комплекс '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' турция',
                                        ];
                                    @endphp
                                    <div class="swiper-slide">
                                        <a href="{{ url(''.$url_lang.'/old-projects/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}" class="card">
                                            @if(!empty($project->availability))
                                                <div class="sale-status-project">
                                                    {{ $project->availability }} {{ __('main.apartments_available') }}
                                                </div>
                                            @endif
                                            <div class="card-img">
                                                <img
                                                    src="@if($project->images->post){{ asset('upload/projects/post') }}/{{ $project->images->post }}@else{{ asset('/upload/default_project_post.jpg') }}@endif"
                                                    title="{{ $project->images->post_alt }}"
                                                    alt="{{ $project->images->post_alt }}"
                                                    width="240" height="240">
                                            </div>
                                            <div class="info">
                                                <div class="body">
                                                    <div class="card-header">
                                                        <p> {{ mb_strimwidth($project['name_'.$lang], 0, 17, "...") }} </p>
                                                        <button
                                                            class="btn btn-azure">@lang('main.more')</button>
                                                    </div>
                                                    <div class="details-project">
                                                        <span>{{ $project->city['name_'.$lang] }}{{ __(' :  ') }} {{ $project->district['name_'.$lang] }}</span>
                                                        <span>{{ ucfirst(__('main.layouts')) }}{{ __(' :  ') }} {{ $project->layouts }}</span>
                                                        <span>{{ ucfirst(__('main.sea')) }}{{ __(' : ') }} {{ $project->sea }} {{ __('м') }}</span>
                                                    </div>
                                                    <div class="footer">
                                                        <div class="logo-box">
                                                            <img
                                                                src="@if($project->images->post){{ asset('upload/projects/logo') }}/{{ $project->images->logo }}@else{{ asset('/upload/default_project_logo.png') }}@endif"
                                                                title="{{ $project->images->logo_alt }}"
                                                                alt="{{ $project->images->logo_alt }}"
                                                                width="80px" height="60px">
                                                        </div>
                                                        <p>@lang('main.from') {{ $project->price }} @lang('main.currency')</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="pagination-area">
                            {{ $new_projects->links() }}
                        </div>
                    @else
                        <div class="flex-space-b header-block">
                            <h4>{{ ucfirst(__('main.nothing_found')) }}</h4>
                        </div>
                    @endif
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

{{--<style>--}}

{{--    .dashboard .right .sidebar .search .box h4{--}}
{{--        text-align: center;--}}
{{--    }--}}

{{--    @media (max-width: 1199px) {--}}
{{--        .dashboard .card-grid-trio {--}}
{{--            gap: 32px;--}}
{{--        }--}}
{{--    }--}}

{{--    @media (max-width: 1023px) {--}}
{{--        .dashboard .card-grid-trio {--}}
{{--            grid-template-columns: repeat(2, 1fr);--}}
{{--            gap: 32px;--}}
{{--        }--}}

{{--        .card{--}}
{{--            margin: auto;--}}
{{--        }--}}
{{--    }--}}

{{--    @media (max-width: 768px) {--}}
{{--        .dashboard .card-grid-trio {--}}
{{--            grid-template-columns: repeat(1, 1fr);--}}
{{--        }--}}

{{--        .card, .projects-cards{--}}
{{--            margin: auto;--}}
{{--        }--}}
{{--    }--}}

{{--</style>--}}
