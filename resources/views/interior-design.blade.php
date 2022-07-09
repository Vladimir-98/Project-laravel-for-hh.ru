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
@section('canonical', url('/'.$lang_canonical.'interior-design'))
@section('data-form', 'Заявка со страницы дизайна.')

<x-app-layout>
    <div class="page-content-wrapper " style="margin-bottom: 32px">
        <div class="page-content-wrapper__img element-animation">
            <img src="{{ asset('/upload/flag.png') }}" width="400" height="670" alt="img"/>
        </div>
        <div class="container"  id="positionTop">
            <div class="page-breadcrumb">
                <div>
                    <a href="{{ $url_lang }}">{{ ucfirst(__('main.home')) }}</a>
                    <span>{{ ucfirst(__('main.interior_design')) }}</span>
                </div>
            </div>
            <div class="columns catalog-block">
                <div class="left">
                    <div class="block project-page">
                        @if(!empty($page->about))
                            @if(!empty($page->about['title_about_'.$lang]))
                                <div class="flex-space-b header-block">
                                    <h3>{{ $page->about['title_about_'.$lang] }}</h3>
                                </div>
                            @endif
                            <div class="img-text-block">
                                <p class="text-paragraph">
                                    <img
                                        src="@if(!empty($page->about->about_img)){{ asset('upload/pages/about') }}/{{ $page->about['about_img'.$agent] }}@else{{ asset('upload/default_project_catalog.jpg') }}@endif"
                                        title="@if(!empty($page->about->about_img_alt)){{ $page->about->about_img_alt }}@endif"
                                        alt="@if(!empty($page->about->about_img_alt)){{ $page->about->about_img_alt }}@endif"
                                        width="410px" height="250px">

                                    @if(!empty($page->about['description_about_'.$lang]))
                                        {!! $page->about['description_about_'.$lang] !!}
                                    @endif
                                </p>
                            </div>
                        @endif
                        @if (count($page->sliders) !== 0)
                            <div class="fake-offset" id="positionSlider">
                                <div class="project-text-block">
                                <div class="swiper-apartments-area">
                                    <div class="swiper swiper-apartments-small">
                                        <div class="swiper-wrapper">
                                            @foreach($page->sliders as $slide)
                                                <div class="swiper-slide slider_apartment_medium">
                                                    <img src="{{ asset('upload/pages/slider') }}/{{ $slide['image'.$agent] }}" title="{{ $slide->image_alt }}" alt="{{ $slide->image_alt }}"/>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                    <div class="swiper swiper-apartments">
                                        <div class="swiper-wrapper">
                                            @foreach($page->sliders as $slide)
                                                <div class="swiper-slide slider_apartment_small">
                                                    <img src="{{ asset('upload/pages/slider') }}/{{ $slide->image_small }}"
                                                         title="{{ $slide->image_alt }}"
                                                         alt="{{ $slide->image_alt }}"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endif
                        @if(!empty($page->review['title_review_'.$lang]) || !empty($page->review['description_review_'.$lang]))
                            <div class="fake-offset" id="positionDescription">
                                @if(!empty($page->review['title_review_'.$lang]))
                                    <div class="flex-space-b header-block">
                                        <h3>{{ ucfirst($page->review['title_review_'.$lang]) }}</h3>
                                    </div>
                                @endif
                                @if(!empty($page->review['description_review_'.$lang]))
                                    <div class="img-text-block">
                                        <p class="text-paragraph">
                                            {!! $page->review['description_review_'.$lang] !!}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if (!empty($page->video->url))
                            <div class="fake-offset project-content" id="positionVideo">
                                <div class="project-text-block">
                                    <div class="video-area">
                                        <div class="video-box">
                                            <iframe src="{{ $page->video->url }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="fake-offset" id="reviews">
                        <div class="block reviews_block">
                            <div class="flex-space-b header-block">
                                <p class="h3_title">
                                    @if(count($reviews) != 0)
                                        @lang('main.project_reviews')
                                    @else
                                        @lang('main.no_reviews')
                                    @endif
                                </p>
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
                                                <input type="hidden" name="review_id" value="{{ $page->id }}">
                                                <input type="hidden" name="review_type" value="Page">
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
                    <div class="sidebar">
                        @include('layouts.search')
                        <div class="nav-list">
                            <x-leave-request/>
                            <div class="navigation-box" onclick="getSidebarDropdown(this, 'blue')">
                                <div class="down-icon"
                                     style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
                                <a href="javascript:void(0)" class="btn btn-category-dropdown">@lang('main.nav_sidebar')</a>
                            </div>
                            <div class="navigation-dropdown">
                                <div class="navigation_dropdown_links">
                                    @if(!empty($page->review))
                                        <div class="nav-link">
                                            <a href="#positionTop">@lang('main.description')</a>
                                        </div>
                                    @endif
                                    @if(!empty($page->sliders))
                                        <div class="nav-link">
                                            <a href="#positionSlider">@lang('main.our_works')</a>
                                        </div>
                                    @endif
                                    @if(!empty($page->review))
                                        <div class="nav-link">
                                            <a href="#positionDescription">@lang('main.advantage')</a>
                                        </div>
                                    @endif
                                    @if(!empty($page->review))
                                        <div class="nav-link">
                                            <a href="#positionVideo">@lang('main.video')</a>
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
    @push('scripts')
        <script src="{{ asset('/js/сontenteditable-reviews.js') }}"></script>
    @endpush
</x-app-layout>



