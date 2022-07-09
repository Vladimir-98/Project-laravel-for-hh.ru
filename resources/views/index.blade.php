@php
    $lang = app()->getLocale();
    $url_lang = $lang;
    if ( $lang == 'ru' ) { $url_lang = ''; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang;

@endphp
{{--@dd(session()->all())--}}
@if(!empty($page->meta['title_meta_' . $lang]))
    @section('title_meta', htmlspecialchars($page->meta['title_meta_' . $lang]))
@endif
@if(!empty($page->meta['description_meta_' . $lang]))
    @section('description_meta', strip_tags(str_replace("\xC2\xA0", " ", $page->meta['description_meta_' . $lang])))
@endif
@section('canonical', url('/'.$lang_canonical))
@section('data-form', 'Заявка с главной страницы.')

<x-app-layout>
    @if(!empty($page->header['header_img']))
        <div class="img-box">
            <div class="img" style="background:
            @if(!empty($page->header['header_img']))
                url(/upload/pages/header/{{ $page->header['header_img'.$agent] }})no-repeat center/cover
            @else
                url(/upload/default_project_catalog.jpg)no-repeat center/cover
            @endif">
                <div class="container">
                    <div class="description-box">
                        @if(!empty($page->header['title_header_'.$lang]))
                            <h1>{{ $page->header['title_header_'.$lang] }}</h1>
                        @endif
                        @if(!empty($page->header['description_header_'.$lang]))
                            <p>
                                {{ $page->header['description_header_'.$lang] }}
                            </p>
                        @endif
                    </div>
                </div>
                @if(count($news) != 0)
                    <div class="news-area container">
                        <div class="news swiper">
                            <div class="card-grid-trio swiper-wrapper swiper-wrapper_custom">
                                @foreach($news as $post)
                                    <div class="swiper-slide">
                                        <a href="{{ asset(''.$url_lang.'/news/'.$post->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($post['title_ru'], $translate)) ) ) }}" class="card-light-news">
                                            <div class="card-img">
                                                <img src="{{ asset('upload/news') }}/{{ $post->images->post_small }}"
                                                     title="{{ $post->images->post_alt }}"
                                                     alt="{{ $post->images->post_alt }}"
                                                width="100"
                                                height="100">
                                            </div>
                                            <div class="text">
                                                <span class="h4_title">{{ mb_strimwidth($post['title_'.$lang], 0, 20, "...") }}</span>
                                                <p>{!! mb_strimwidth($post['description_'.$lang], 0, 38, "...") !!}</p>
                                                <div class="details">
                                                    <p>{{ date_format($post->created_at, 'd.m.Y') }}</p>
                                                    <span class="right-icon" title="get news"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="page-content-wrapper" id="mainContainer">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="columns">
                <div class="left">
                    @if(!empty($page->about))
                        <div class="fake-offset" id="aboutPosition">
                            <div class="block">
                                @if(!empty($page->about['title_about_'.$lang]))
                                    <div class="flex-space-b header-block">
                                        <h2 class="h3_title">{{ $page->about['title_about_'.$lang] }}</h2>
                                    </div>
                                @endif
                                <div class="img-text-block">
                                    <p class="text-paragraph">
                                        <img
                                            src="@if(!empty($page->about->about_img)){{ asset('upload/pages/about') }}/{{ $page->about['about_img'.$agent] }}@else{{ asset('upload/default_project_catalog.jpg') }}@endif"
                                            title="{{ $page->about->about_img_alt }}"
                                            alt="{{ $page->about->about_img_alt }}"
                                            width="410px" height="250px">

                                        @if(!empty($page->about['description_about_'.$lang]))
                                            {!! $page->about['description_about_'.$lang] !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($new_projects) != 0)
                        <div class="fake-offset" id="oldProjectsPosition">
                            <div class="block">
                                <div class="flex-space-b header-block">
                                    @if(!empty($page->title['page_title_one_'.$lang]))
                                        <h3>{{ $page->title['page_title_one_'.$lang] }}</h3>
                                    @endif
                                    <a href="{{ route('old-projects') }}" class="btn btn-white">@lang('main.view_all')</a>
                                </div>
                                <div class="swiper projects-cards">
                                    <div class="card-grid-two swiper-wrapper swiper-wrapper_custom">
                                        @foreach($new_projects as $project)
                                            @php
                                                $urls_arr = [
                                                    'url_en' => $project->id.' residential complex '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' turkey',
                                                    'url_tr' => $project->id.' konut kompleksi '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' türkiye',
                                                    'url_ru' => $project->id.' жилой комплекс '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' турция',
                                                ];
                                            @endphp
                                            <div class="swiper-slide">
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
                                                        <div class="logo-box">
                                                            <img
                                                                src="@if($project->images->post){{ asset('upload/projects/logo') }}/{{ $project->images->logo }}@else{{ asset('/upload/default_project_logo.png') }}@endif"
                                                                title="{{ $project->images->logo_alt }}"
                                                                alt="{{ $project->images->logo_alt }}"
                                                                width="80px" height="60px">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($old_projects) != 0)
                        <div class="fake-offset" id="newProjectsPosition">
                            <div class="block">
                                <div class="flex-space-b header-block">
                                    @if(!empty($page->title['page_title_two_'.$lang]))
                                        <h3>{{ $page->title['page_title_two_'.$lang] }}</h3>
                                    @endif
                                    <a href="{{ route('new-projects') }}" class="btn btn-white">@lang('main.view_all')</a>
                                </div>
                                <div class="projects-cards swiper">
                                    <div class="card-grid-two swiper-wrapper swiper-wrapper_custom">
                                        @foreach($old_projects as $project)
                                            @php
                                                $urls_arr = [
                                                    'url_en' => $project->id.' residential complex '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' turkey',
                                                    'url_tr' => $project->id.' konut kompleksi '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' türkiye',
                                                    'url_ru' => $project->id.' жилой комплекс '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' турция',
                                                ];
                                            @endphp
                                            <div class="swiper-slide">
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
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($apartments) != 0)
                        <div class="fake-offset" id="apartmentsPosition">
                            <div class="block">
                                <div class="flex-space-b header-block">
                                    @if(!empty($page->title['page_title_three_'.$lang]))
                                        <h3>{{ $page->title['page_title_three_'.$lang] }}</h3>
                                    @endif
                                    <a href="{{ route('apartments') }}" class="btn btn-white">@lang('main.view_all')</a>
                                </div>
                                <div class="apartments-cards swiper">
                                    <div class="card-grid-trio swiper-wrapper swiper-wrapper_custom">
                                        @foreach($apartments as $apartment)
                                            @php
                                                $urls_arr = [
                                                    'url_en' => $apartment->id.' apartment for sale '.$apartment->layout.'+1 turkey',
                                                    'url_tr' => $apartment->id.' satılık daire '.$apartment->layout.'+1 '.$apartment->city['name_'.$lang].' türkiye',
                                                    'url_ru' => $apartment->id.' продажа квартиры '.$apartment->layout.'+1 '.$apartment->city['name_'.$lang].' турция',
                                                ];
                                            @endphp
                                            <div class="swiper-slide">
                                                <div class="card">
                                                    @if(!empty($apartment->status))
                                                        <div class="sale-status-project">
                                                            @if ($apartment->status == 1)
                                                                {{ __('main.urgent_sale') }}
                                                            @endif
                                                        </div>
                                                    @endif
                                                    <div class="card-img">
                                                        <img
                                                            src="{{ asset('upload/apartments/post') }}/{{ $apartment->images->post }}"
                                                            title="{{ $apartment->images->post_alt }}"
                                                            alt="{{ $apartment->images->post_alt }}"
                                                            width="240px" height="240px">
                                                            <div class="heart">
                                                                <img data-name="Apartments" data-id="{{ $apartment->id }}"
                                                                     @if(session()->has('data.apartments') && in_array($apartment->id, session()->get('data.apartments')))
                                                                     src="{{ asset('upload/svg/heart-red.svg') }}" alt="heart-red" width="30" height="30"
                                                                     @else
                                                                     src="{{ asset('upload/svg/heart-white.svg') }}" alt="heart-white" width="30" height="30"
                                                                    @endif
                                                                >
                                                            </div>
                                                    </div>
                                                    <div class="info">
                                                        <div class="body">
                                                            <div class="card-header">
                                                                <p>
                                                                    {{ $apartment->layout }}@lang('main.room_apartment')
                                                                </p>
                                                            </div>
                                                            <div class="details-project">
                                                                <span>{{ $apartment->city['name_'.$lang] }}{{ __(' : ') }} {{ $apartment->district['name_'.$lang] }}</span>
                                                                <span>{{ ucfirst(__('main.layout')) }}{{ __(' :  ') }} {{ $apartment->layout }}{{ __(' + 1 ') }}</span>
                                                                <span>{{ ucfirst(__('main.quadrature')) }}{{ __(' : ') }} {{ $apartment->quadrature }} {{ __('м') }}&#178</span>
                                                                <span>{{ ucfirst(__('main.sea')) }}{{ __(' : ') }} {{ $apartment->sea }} {{ __('м') }}</span>
                                                                <span>{{ ucfirst(__('main.floor')) }}{{ __(' : ') }} {{ $apartment->floor }}{{ __(' / ') }}{{ $apartment->floors }}</span>
                                                            </div>
                                                            <div class="footer flex-space-b">
                                                                <a title="{{ $urls_arr['url_'.$lang] }}"  target="_blank" href="{{ asset(''.$url_lang.'/apartments/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}" class="btn-azure">{{ __('main.more') }}</a>

                                                                <p class="price-home">{{ number_format($apartment->price, 0, '', ' ') }} @lang('main.currency')</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($questions) != 0)
                        <div class="fake-offset" id="quentionsPosition">
                            <div class="block">
                                <div class="flex-space-b header-block">
                                    @if(!empty($page->title['page_title_four_'.$lang]))
                                        <h2 class="h3_title">{{ $page->title['page_title_four_'.$lang] }}</h2>
                                    @endif
                                    <a href="{{ route('questions') }}" class="btn btn-white">@lang('main.view_all')</a>
                                </div>
                                <div class="faq">
                                    <div class="card-grid-trio">
                                        @for($i = 0; $i < count($questions); $i++)
                                            <div class="card-faq">
                                                <div class="card-header">
                                                    <div>{{ mb_strimwidth($questions[$i]['title_'.$lang], 0, 20, "...") }}</div>
                                                    <span>{{ __('0') }}{{ $i + 1 }}</span>
                                                </div>
                                                <p class="text-paragraph">
                                                    {!! mb_strimwidth($questions[$i]['description_'.$lang], 0, 90, "...") !!}
                                                </p>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(count($reviews) != 0)
                        <div class="fake-offset" id="reviewsPosition">
                            <div class="block">
                                @if(!empty($page->reviews['title_review_'.$lang]))
                                    <div class="flex-space-b header-block">
                                        <h3>{{ $page->reviews['title_review_'.$lang] }}</h3>
                                    </div>
                                @endif
                                <div class="card-grid-two review_box">
                                    @if(!empty($page->reviews['description_review_'.$lang]))
                                    <div class="img-text-block">
                                        <p class="review-paragraph">
                                            {!! $page->reviews['description_review_'.$lang] !!}
                                        </p>
                                    </div>
                                    @endif
                                    <div class="swiper swiper-review swiperReview">
                                        <div class="swiper-wrapper">
                                            @if($reviews && count($reviews) != 0)
                                            @foreach($reviews as $review)
                                                    @php
                                                        $urls_arr = [
                                                            'url_ru' => $review->project->id.' жилой комплекс '.$review->project['name_'.$lang].' '.$review->project->city['name_'.$lang].' турция',
                                                        ];
                                                    @endphp
                                                <div class="swiper-slide">
                                                    <div class="card card-reviews">
                                                        <div class="info">
                                                            <div class="body">
                                                                <div class="d-flex review-card-header">
                                                                    <p class="name_project">
                                                                        {{ ucfirst(__('main.one_project')) }} {{ ucfirst(mb_strimwidth($review->project['name_'.$lang], 0, 15, "...")) }}
                                                                    </p>
                                                                    <a target="_blank" class="right-icon" title="get project" href="{{ asset(''.$url_lang.'/projects/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}"></a>
                                                                </div>
                                                                <div class="card-header" style="background: @if(!empty($review->project->images->catalog_medium)) url({{ asset('upload/projects/catalog') }}/{{ $review->project->images->catalog_medium }}) @else url({{ asset('upload/default_project_catalog_small.jpg') }}) @endif no-repeat center/cover"></div>
                                                                <div class="review-avatar" style="background: @if(!empty($review->user->avatar)) url({{ asset('upload/avatar') }}/{{ $review->user->avatar }}) @else url({{ asset('upload/svg/white-avatar.svg') }}) @endif no-repeat center/cover"></div>
                                                                <span class="review-title">
                                                                    @if(!empty($review->user->name))
                                                                        {{ $review->user->name }}
                                                                    @endif
                                                                </span>
                                                                <div class="details-review">
                                                                    <p class="text-paragraph">
                                                                        @if(!empty($review->review))
                                                                            {!! mb_strimwidth($review->review, 0, 100, "...") !!}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div class="footer footer-review">
                                                                    <p>12.02.2020</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="right">
                    <div class="sidebar">
                        @include('layouts.search')
                        <div class="nav-list">
                            <x-leave-request/>
                            <div class="navigation-box" onclick="getSidebarDropdown(this, 'blue')">
                                <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                                <span class="btn btn-category-dropdown">@lang('main.nav_sidebar')</span>
                            </div>
                            <div class="navigation-dropdown">
                                <div class="navigation_dropdown_links">
                                    @if(!empty($page->about))
                                        <div class="nav-link">
                                            <a href="#aboutPosition">@lang('main.about')</a>
                                        </div>
                                    @endif
                                    @if(count($new_projects) != 0)
                                        <div class="nav-link">
                                            <a href="#oldProjectsPosition">@lang('main.old-projects_row')</a>
                                        </div>
                                    @endif
                                    @if(count($old_projects) != 0)
                                        <div class="nav-link">
                                            <a href="#newProjectsPosition">@lang('main.new-projects_row')</a>
                                        </div>
                                    @endif
                                    @if(count($apartments) != 0)
                                        <div class="nav-link">
                                            <a href="#apartmentsPosition">@lang('main.apartments')</a>
                                        </div>
                                    @endif
                                    @if(count($questions) != 0)
                                        <div class="nav-link">
                                            <a href="#quentionsPosition">@lang('main.questions')</a>
                                        </div>
                                    @endif
                                    @if(count($reviews) != 0)
                                        <div class="nav-link">
                                            <a href="#reviewsPosition">@lang('main.reviews')</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if(!empty($page->design))
            <section class="blue-container swiper">
{{--                <div class="page-content-wrapper__img element-animation">--}}
{{--                    <img src="{{ asset('/upload/svg/design.svg') }}" width="800" height="800" alt="img">--}}
{{--                </div>--}}
                <div class="container" id="apartmentDesign">
                    <div class="flex-space-b header-block">
                        <h3>@if(!empty($page->design['title_design_'.$lang])){{ $page->design['title_design_'.$lang] }}@endif</h3>
                    </div>
                    <div class="card-grid-trio swiper-wrapper swiper-wrapper_custom">
                        <div class="img_1 swiper-slide">
                            <img src="{{ asset('/upload/pages/design') }}/@if(!empty($page->design['design_img_one'])){{ $page->design['design_img_one'] }}@endif"
                                 title="{{ $page->design->design_img_one_alt }}"
                                 alt="{{ $page->design->design_img_one_alt }}"
                                 width="352" height="436">
                        </div>
                        <div class="img_2 swiper-slide">
                            <img src="{{ asset('/upload/pages/design') }}/@if(!empty($page->design['design_img_two'])){{ $page->design['design_img_two'] }}@endif"
                                 title="{{ $page->design->design_img_two_alt }}"
                                 alt="{{ $page->design->design_img_two_alt }}"
                                 width="371" height="218">
                        </div>
                        <div class="img_3 swiper-slide">
                            <img src="{{ asset('/upload/pages/design') }}/@if(!empty($page->design['design_img_three'])){{ $page->design['design_img_three'] }}@endif"
                                 title="{{ $page->design->design_img_three_alt }}"
                                 alt="{{ $page->design->design_img_three_alt }}"
                                 width="313" height="218">
                        </div>
                        <div class="img_4 swiper-slide">
                            <img src="{{ asset('/upload/pages/design') }}/@if(!empty($page->design['design_img_four'])){{ $page->design['design_img_four'] }}@endif"
                                 title="{{ $page->design->design_img_four_alt }}"
                                 alt="{{ $page->design->design_img_four_alt }}"
                                 width="332" height="315">
                        </div>
                        <div class="img_5 swiper-slide">
                            <img src="{{ asset('/upload/pages/design') }}/@if(!empty($page->design['design_img_five'])){{ $page->design['design_img_five'] }}@endif"
                                 title="{{ $page->design->design_img_five_alt }}"
                                 alt="{{ $page->design->design_img_five_alt }}"
                                 width="254" height="315">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next header-slider-next"></div>
                    <div class="swiper-button-prev header-slider-prev"></div>
                </div>
            </section>
        @endif
        @if(!empty($page->map))
            <section class="fake-offset map">
                <div class="container">
                    <iframe title="map" loading="lazy"  src="@if(!empty($page->map)){{ $page->map->url }}@endif" style="border:0;"  width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    <div class="block">
                        <x-card-form/>
                    </div>
                </div>
            </section>
        @endif
{{--        @endif--}}
    </div>
</x-app-layout>
