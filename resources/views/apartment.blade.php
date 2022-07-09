@php
    $lang = app()->getLocale();
    $url_lang = '/' . $lang;
    if ($lang == 'ru') { $url_lang = '/'; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp

@section('title_meta', $title_arr['title_'.$lang])
@section('description_meta', $description['description_'.$lang])
@section('canonical', url('/'.$lang_canonical.'apartments/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) )))
@section('data-form', 'Заявка по '.$apartment->layout.'-комн. квартире, №-'.$apartment->id.' ('. $apartment->city->name_ru.', '. $apartment->district->name_ru .')')

<x-app-layout>
    <div class="page-content-wrapper">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <a href="{{ route('apartments') }}">{{ ucfirst(__('main.selection_of_real_estate')) }}</a>
                    <span class="d-inline-block">{{ ucfirst($h1_arr['h_'.$lang]) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block project-page" id="photoPosition">
                        <div class="flex-space-b header-block">
                            <h1>
                                {{ ucfirst($h1_arr['h_'.$lang]) }}
                            </h1>
                            <div class="d-flex">
                                <div class="heart">
                                    <img data-name="Apartments" data-id="{{ $apartment->id }}"
                                         @if(session()->has('data.apartments') && in_array($apartment->id, session()->get('data.apartments')))
                                         src="{{ asset('upload/svg/heart-red.svg') }}" alt="heart-red" width="30" height="30"
                                         @else
                                         src="{{ asset('upload/svg/heart-white.svg') }}" alt="heart-white" width="30" height="30"
                                         @endif
                                         style="width: 35px; cursor:pointer;"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="project-content">
                            @if (!empty($apartment->sliders))
                                <div class="project-text-block">
                                    <div class="swiper-apartments-area">
                                        <div class="swiper swiper-apartments-small">
                                            <div class="swiper-wrapper">
                                                @foreach($apartment->sliders as $slide)
                                                    <div class="swiper-slide slider_apartment_medium">
                                                        <img src="{{ asset('upload/apartments/slider') }}/{{ $slide['image'.$agent] }}" title="{{ $slide->image_alt }}" alt="{{ $slide->image_alt }}"/>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                        <div class="swiper swiper-apartments">
                                            <div class="swiper-wrapper">
                                                @foreach($apartment->sliders as $slide)
                                                    <div class="swiper-slide slider_apartment_small">
                                                        <img src="{{ asset('upload/apartments/slider') }}/{{ $slide->image_small }}"
                                                             title="{{ $slide->image_alt }}"
                                                            alt="{{ $slide->image_alt }}"/>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="fake-offset" id="advantagePosition">
                                <div class="project-text-block">
                                    <div class="gradient-box">
                                        <div class="info-project d-flex">
                                            <ul class="card-grid-five">
                                                <li>
                                                    <span>{{ ucfirst(__('main.city')) }}</span>
                                                    <p>{{ $apartment->city['name_'.$lang] }}</p>
                                                </li>
                                                <li>
                                                    <span>{{ ucfirst(__('main.district')) }}</span>
                                                    <p>{{ $apartment->district['name_'.$lang] }}</p>
                                                </li>
                                                @if (!empty($apartment->age))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.house')) }}</span>
                                                        <p>{{ substr($apartment->age, 0, 4) }} @lang('main.years')</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->quadrature))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.quadrature')) }}</span>
                                                        <p>{{ $apartment->quadrature }}{{ __(' м') }}&#178</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->status) && $apartment->status == 1)
                                                    <li>
                                                        <span>{{ ucfirst(__('main.sale_status')) }}</span>
                                                        <p>{{ __('main.urgent_sale') }}</p>
                                                    </li>
                                                @endif
                                                @if ($apartment->floor >= 0)
                                                    <li>
                                                        <span>{{ ucfirst(__('main.floor')) }}</span>
                                                        <p>{{ $apartment->floor }}{{ __(' / ') }}{{ $apartment->floors }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->sea))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.sea')) }}</span>
                                                        <p>{{ $apartment->sea }} {{ __('м') }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->gas))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.gas')) }}</span>

                                                        <p>
                                                            @if ($apartment->gas == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->layout))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.layout')) }}</span>
                                                        <p>{{ $apartment->layout }} {{ __(' + 1') }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->price))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.price')) }}</span>
                                                        <p>{{ number_format($apartment->price, 0, '', ' ') }} @lang('main.currency')</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->аidat))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.aidat')) }}</span>
                                                        <p>{{ $apartment->аidat }}{{ __(' ₺') }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->balcony))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.balcony')) }}</span>
                                                        <p>{{ $apartment->balcony }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->kitchen))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.kitchen')) }}</span>
                                                        @if($apartment->kitchen == 1)
                                                            <p>@lang('main.combined')</p>
                                                        @else
                                                            <p>@lang('main.separate')</p>
                                                        @endif
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->bathroom))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.bathroom')) }}</span>
                                                        <p>{{ $apartment->bathroom }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->bedroom))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.bedroom')) }}</span>
                                                        <p>{{ $apartment->bedroom }}</p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->furniture))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.furniture')) }}</span>
                                                        <p>
                                                            @if($apartment->furniture == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->pool))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.pool')) }}</span>
                                                        <p>
                                                            @if($apartment->pool == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->sauna))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.sauna')) }}</span>
                                                        <p>
                                                            @if($apartment->sauna == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->hammam))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.hammam')) }}</span>
                                                        <p>
                                                            @if($apartment->hammam == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->fitness))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.fitness_room')) }}</span>
                                                        <p>
                                                            @if($apartment->fitness == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->relaxation))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.recreation')) }}</span>
                                                        <p>
                                                            @if($apartment->relaxation == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->barbecue))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.barbecue_area')) }}</span>
                                                        <p>
                                                            @if($apartment->barbecue == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                                @if (!empty($apartment->sport))
                                                    <li>
                                                        <span>{{ ucfirst(__('main.area_sports_ground')) }}</span>
                                                        <p>
                                                            @if($apartment->sport == 1)
                                                                @lang('main.there_is')
                                                            @else
                                                                @lang('main.no')
                                                            @endif
                                                        </p>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($apartment->description))
                                <div class="fake-offset" id="descriptionPosition">
                                    <div class="flex-space-b header-block">
                                        <h2 class="h3_title">{{ $apartment->description['title_'.$lang] }}</h2>
                                    </div>
                                    <div class="project-text-block">
                                        <p class="text-paragraph">
                                            {!! $apartment->description['description_'.$lang] !!}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($apartment->video->url))
                                <div class="fake-offset" id="videoPosition">
                                    <div class="project-text-block">
                                        <div class="video-area">
                                            <div class="video-box">
                                                <iframe src="{{ $apartment->video->url }}"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (!empty($apartment->map->url))
                                <div class="fake-offset" id="locationPosition">
                                    <div class="flex-space-b header-block">
                                        <h3>{{ ucfirst(__('main.location')) }}</h3>
                                    </div>
                                    <div class="project-text-block">
                                        <section class="map">
                                            <iframe src="{{ $apartment->map->url }}" style="border:0;"> </iframe>
                                        </section>
                                    </div>
                                </div>
                            @endif
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
</x-app-layout>



