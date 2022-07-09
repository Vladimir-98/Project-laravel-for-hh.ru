@php
    $lang = app()->getLocale();
    $url_lang = '/' . $lang; if ($lang == 'ru') { $url_lang = '/'; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';

@endphp

@section('title_meta', $title_arr['title_'.$lang])
@if(!empty($project->meta['description_meta_' . $lang]))
    @section('description_meta', strip_tags(str_replace("\xC2\xA0", " ", $project->meta['description_meta_' . $lang])))
@endif
@section('canonical', url('/'.$lang_canonical.'projects/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) )))
@section('data-form', 'Заявка по проекту "'.$project->name_ru.'" №-'.$project->id.' ('. $project->city->name_ru.', '. $project->district->name_ru .')')

<x-app-layout>
    @if(count($project->sliders) > 0)
        <div class="slider-catalog">
            <div class="container">
                <div class="header-slider-swiper swiper" style="height: 500px">
                    <div class="swiper-wrapper">
                        @foreach($project->sliders as $slide)
                            <div class="swiper-slide">
                                <div class="project-slider-banner" style="background: url(/upload/projects/slider/{{ $slide->image }})no-repeat center/cover" >
                                    <div class="content">
                                        <div class="slider-title">
                                            <span>{{ $slide['title_'.$lang] }}</span>
                                        </div>
                                        <p>
                                            {{ $slide['description_'.$lang] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="header-slider-next swiper-button-next"></div>
                    <div class="header-slider-prev swiper-button-prev"></div>
                </div>
            </div>
        </div>
    @endif
    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    @if($project->deadline < Carbon\Carbon::now())
                        <a href="{{ route('old-projects') }}">{{ ucfirst(__('main.old-projects_row')) }}</a>
                    @else
                        <a href="{{ route('new-projects') }}">{{ ucfirst(__('main.new-projects_row')) }}</a>
                    @endif
                    <span>{{ ucfirst($project['name_'.$lang]) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block project-page" id="videoPosition">
                        <div class="flex-space-b header-block">
                            <h1>
                                {{ ucfirst(__('main.project')) }}
                                {{ ucfirst($project['name_'.$lang]) }}
                                @if(!empty($project->city))
                                    {{ __(' - ') }}{{ $project->city['name_'.$lang] }}
                                @endif
                                @if(!empty($project->district))
                                    {{ __(' (') }}{{ $project->district['name_'.$lang] }}{{__(')')}}
                                @endif
                            </h1>
                            <div class="d-flex">
                                @if (!empty($project->images->logo))
                                    <div class="page-logo">
                                        <img src="{{ asset('upload/projects/logo/'.$project->images->logo) }}" width="70" height="50" title="{{ $project->images->logo }}" alt="{{ $project->images->logo }}">
                                    </div>
                                @endif
                                <div class="heart">
                                    <img data-name="Project" data-id="{{ $project->id }}"
                                         @if(session()->has('data.projects') && in_array($project->id, session()->get('data.projects')))
                                         src="{{ asset('upload/svg/heart-red.svg') }}" alt="heart-red" width="30" height="30"
                                         @else
                                         src="{{ asset('upload/svg/heart-white.svg') }}" alt="heart-white" width="30" height="30"
                                         @endif
                                         style="width: 35px; cursor:pointer;"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="project-content" id="videoPosition">
                            @if (!empty($project->video->url))
                                <div class="project-text-block">
                                    <div class="video-area">
                                        <div class="video-box">
                                            <iframe title="Video Sultan_2699" src="{{ $project->video->url }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div @if (!empty($project->video->url))class="fake-offset" @endif id="advantagePosition">
                                <div class="project-text-block">
                                    <div class="gradient-box">
                                        <div class="info-project d-flex">
                                            <ul class="card-grid-five">
                                                <li>
                                                    <span>{{ ucfirst(__('main.city')) }}</span>
                                                    <p>{{ $project->city['name_'.$lang] }}</p>
                                                </li>
                                                <li>
                                                    <span>{{ ucfirst(__('main.district')) }}</span>
                                                    <p>{{ $project->district['name_'.$lang] }}</p>
                                                </li>
                                                @if (!empty($project->deadline))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.deadline')) }}</span>
                                                        <p>
                                                            {{ date('d.m.Y', strtotime($project->deadline)) }}
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->floors))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.floors')) }}</span>
                                                        <p>{{ $project->floors }}</p>
                                                    </li>
                                                @endif
                                                @if ($project->sea >= 0)
                                                    <li>
                                                        <span>{{ ucfirst(__('main.sea')) }}</span>
                                                        <p>{{ $project->sea }} {{ __('м') }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->gas))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.gas')) }}</span>

                                                        <p>
                                                            @if ($project->gas == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->layouts))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.layouts')) }}</span>
                                                        <p>{{ $project->layouts }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->price))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.price')) }}</span>
                                                        <p>@lang('main.from')  {{ number_format($project->price, 0, '', ' ') }} @lang('main.currency')</p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->аidat))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.aidat')) }}</span>
                                                        <p>{{ $project->аidat }}{{ __(' ₺') }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->installments))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.installments')) }}</span>

                                                        <p>
                                                            @if ($project->installments == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->pool))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.pool')) }}</span>
                                                        <p>
                                                            @if($project->pool == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->sauna))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.sauna')) }}</span>
                                                        <p>
                                                            @if($project->sauna == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->hammam))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.hammam')) }}</span>
                                                        <p>
                                                            @if($project->hammam == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->fitness))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.fitness_room')) }}</span>
                                                        <p>
                                                            @if($project->fitness == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->relaxation))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.recreation')) }}</span>
                                                        <p>
                                                            @if($project->relaxation == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->barbecue))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.barbecue_area')) }}</span>
                                                        <p>
                                                            @if($project->barbecue == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->sport))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.area_sports_ground')) }}</span>
                                                        <p>
                                                            @if($project->sport == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($project->availability))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.availability_apartments')) }}</span>
                                                        <p>{{ $project->availability }}</p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($project->description))
                                <div class="fake-offset" id="descriptionPosition">
                                    <div class="flex-space-b header-block">
                                        <h2 class="h3_title">{{ $project->description['title_'.$lang] }}</h2>
                                    </div>
                                    <div class="project-text-block">
                                        <p class="text-paragraph">
                                            {!! $project->description['description_'.$lang] !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($project->plan))
                                <div class="fake-offset" id="3dPlanPosition">
                                    @if (!empty($project->plan['title_'.$lang]))
                                    <div class="flex-space-b header-block">
                                        <h3>{{ $project->plan['title_'.$lang] }}</h3>
                                    </div>
                                    @endif
                                    @if (!empty($project->plan->image))
                                    <div class="project-text-block">
                                        <div class="page-banner">
                                            <img width="360px" height="237px" src="{{ asset('upload/projects/plan') }}{{ __('/') }}{{ $project->plan['image'.$agent] }}" title="{{ $project->plan->image_alt }}" alt="{{ $project->plan->image_alt }}">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            @if(count($project->layoutSlider))
                                <div class="fake-offset" id="layoutsPosition">
                                    @if(!empty($project->layoutDescription['title_'.$lang]))
                                        <div class="flex-space-b header-block">
                                            <h3>{{ $project->layoutDescription['title_'.$lang] }}</h3>
                                        </div>
                                    @endif
                                    @if(!empty($project->layoutDescription['description_'.$lang]))
                                        <div class="project-text-block">
                                            <p class="text-paragraph">
                                                 {!! $project->layoutDescription['description_'.$lang] !!}
                                            </p>
                                        </div>
                                    @endif
                                    @if (count($project->layoutSlider))
                                        <div class="apartments-cards swiper layouts_area">
                                            <div class="card-grid-trio swiper-wrapper">
                                                @foreach($project->layoutSlider as $slide)
                                                    <div class="swiper-slide">
                                                        <div class="card-animation">
                                                            <div class="element-animation">
                                                                <img width="246" height="194" src="{{ asset('/upload/projects/layouts') }}/{{ $slide->image }}" title="{{ $slide->image_alt }}" alt="{{ $slide->image_alt }}">
                                                            </div>
{{--                                                            @if(!empty($slide->layout))--}}
{{--                                                                <div class="apartment-card-title">--}}
{{--                                                                    <span>{{ $slide->layout }}{{ __(' + 1') }}</span>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
                                                            <ul>
                                                                @if(!empty($slide->layout))
                                                                    <li>
                                                                        <span class="text-paragraph">{{ ucfirst(__('main.layout')) }}{{ __(':') }}</span>
                                                                        <p>{{ $slide->layout }}{{ __(' + 1') }}</p>
                                                                    </li>
                                                                @endif
                                                                @if(!empty($slide->balcony))
                                                                    <li>
                                                                        <span class="text-paragraph">{{ ucfirst(__('main.balcony')) }}{{ __(':') }}</span>
                                                                        <p>{{ $slide->balcony }}</p>
                                                                    </li>
                                                                @endif
                                                                @if(!empty($slide->quadrature))
                                                                    <li>
                                                                        <span class="text-paragraph">{{ ucfirst(__('main.quadrature')) }}{{ __(':') }}</span>
                                                                        <p>{{ $slide->quadrature }}{{ __('м') }}&#178</p>
                                                                    </li>
                                                                @endif
                                                                @if(!empty($slide->bathroom))
                                                                    <li>
                                                                        <span class="text-paragraph">{{ ucfirst(__('main.bathroom')) }}{{ __(':') }}</span>
                                                                        <p>{{ $slide->bathroom }}</p>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if (!empty($project->infrastructure))
                                <div class="fake-offset" id="infrastructurePosition">
                                    <div class="flex-space-b header-block">
                                        <h2 class="h3_title">{{ $project->infrastructure['title_'.$lang] }}</h2>
                                    </div>
                                    <div class="project-text-block">
                                        <p class="text-paragraph">
                                            {!! $project->infrastructure['description_'.$lang] !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if(count($project->apartments) != 0)
                                <div class="fake-offset" id="apartmentsPosition">
                                    <div class="flex-space-b header-block">
                                        <h3>@lang('main.apartments')</h3>
                                    </div>
                                    <div class="swiper apartments-cards" style="padding-top: 0; padding-bottom: 0">
                                        <div class="card-grid-trio swiper-wrapper swiper-wrapper_custom">
                                            @foreach($project->apartments as $project_apartment)
                                                @php
                                                    $urls_arr = [
                                                        'url_en' => $project_apartment->id.' apartment for sale '.$project_apartment->layout.'+1 turkey',
                                                        'url_tr' => $project_apartment->id.' satılık daire '.$project_apartment->layout.'+1 '.$project_apartment->city['name_'.$lang].' türkiye',
                                                        'url_ru' => $project_apartment->id.' продажа квартиры '.$project_apartment->layout.'+1 '.$project_apartment->city['name_'.$lang].' турция',
                                                    ];
                                                @endphp
                                                <div class="swiper-slide">
                                                    <div class="card">
                                                        <div class="card-img element-animation">
                                                            <a target="_blank" href="{{ asset(''.$url_lang.'/apartments/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}">
                                                            <img
                                                                src="{{ asset('upload/apartments/post') }}/{{ $project_apartment->images->post }}"
                                                                title="{{ $project_apartment->images->post_alt }}"
                                                                alt="{{ $project_apartment->images->post_alt }}"
                                                                width="240px" height="240px">
                                                            </a>
                                                            <div class="heart">
                                                                <img data-name="Apartments" data-id="{{ $project_apartment->id }}"
                                                                     @if(session()->has('data.apartments') && in_array($project_apartment->id, session()->get('data.apartments')))
                                                                     src="{{ asset('upload/svg/heart-red.svg') }}" alt="heart-red" width="30" height="30"
                                                                     @else
                                                                     src="{{ asset('upload/svg/heart-white.svg') }}" alt="heart-white" width="30" height="30"
                                                                    @endif
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="apartment-card-title">
                                                            <span>{{ $project_apartment->layout.'+1 ' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($project->map->url))
                                <div class="fake-offset" id="locationPosition">
                                    <div class="flex-space-b header-block">
                                        <h4 class="h3_title">{{ ucfirst(__('main.location')) }}</h4>
                                    </div>
                                    <div class="project-text-block">
                                        <section class="map">
                                            <iframe title="map Sultan_2699" src="{{ $project->map->url }}" style="border:0;"> </iframe>
                                        </section>
                                    </div>
                                </div>
                            @endif
                            @if (count($project->progress))
                                <div class="fake-offset" id="progressTitlePosition">
                                    <div class="flex-space-b header-block">
                                        <h4 class="h3_title">@if(!empty($project->progressTitle)){{ $project->progressTitle['title_'.$lang] }}@endif</h4>
                                    </div>
                                    @if(count($project->progress))
                                        <div class="project-text-block сonstruction-progress swiper">
                                            <div class="card-grid-trio swiper-wrapper swiper-wrapper_custom">
                                                @foreach($project->progress as $progress)
                                                    <div class="swiper-slide">
                                                        <div class="card">
                                                            <div class="sale-status-project">@if(!empty($progress)){{ $progress['title_img_'.$lang] }}@endif</div>
                                                            <div class="date-building">{{ date('d.m.Y', strtotime($progress->date)) }}</div>
                                                            <div class="card-img">
                                                                @if(!empty($progress->image))
                                                                    <img width="382" height="185" src="{{ asset('upload/projects/progress') }}/{{ $progress->image }}" title="{{ $progress->image_alt }}" alt="{{ $progress->image_alt }}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="header-slider-next swiper-button-next"></div>
                                            <div class="header-slider-prev swiper-button-prev"></div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="fake-offset" id="reviewsPosition">
                        <div class="block reviews_block">
                            <div class="header-block">
                                <h4 class="h3_title">
                                    @if(count($reviews) != 0)
                                        @lang('main.project_reviews')
                                    @else
                                        @lang('main.no_reviews')
                                    @endif
                                </h4>
                            </div>
                            <div class="project-text-block">
                                <div class="flex-space-b">
                                    <div class="avatar" style="background:
                                    @if(Auth::check() && Auth::user()->avatar) url({{ asset('upload/avatar') }}/{{ Auth::user()->avatar }})
                                    @else url({{ asset('upload/svg/avatar.svg') }})
                                    @endif no-repeat center/cover"></div>
                                    <div class="form-group" style="position: relative">
                                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)"
                                             data-placeholder="@if(!Auth::check()) @lang('main.review_auth') @else @lang('main.review')... @endif"
                                        ></div>
                                        @if(Auth::check())
                                            <form action="{{ route('add-review') }}" method="post">
                                        @csrf
                                        @endif
                                            <textarea id="sendTextArea" name="review" type="text" style="display: none"></textarea>
                                            <input type="hidden" name="review_id" value="{{ $project->id }}">
                                            <input type="hidden" name="review_type" value="Project">
                                        @if(Auth::check())
                                            <button type="button" class="send_review btn">
                                                <img src="{{ asset('/upload/svg/send.svg') }}" alt="send">
                                            </button>
                                        </form>
                                        @endif
                                        <div class="alertReview"></div>
                                    </div>
                                </div>
                                <hr style="margin-top: 16px">
                                <!--  One review-->
                                <div id="getReviews">
                                    @include('layouts.reviews')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="sidebar" id="boxFilter">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid"></div>
        @push('scripts')
            <script src="{{ asset('/js/сontenteditable-reviews.js') }}"></script>
        @endpush
</x-app-layout>



