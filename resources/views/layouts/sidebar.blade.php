<?php
$lang = app()->getLocale();

$url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }

?>
@include('layouts.search')
<div class="nav-list">
    <x-leave-request/>
        <div class="navigation-box" onclick="getSidebarDropdown(this, '')">
            <div class="down-icon" style="background-image: url({{ asset('/upload/svg/down-dropdown.svg') }});"></div>
            <div class="btn btn-category-dropdown">
                @if(isset($questions) || isset($question))
                    @lang('main.popular')
                @elseif(isset($news) || isset($one_news))
                    @lang('main.last')
                @elseif(isset($apartment) || isset($project))
                    @lang('main.nav_sidebar')
                @endif
            </div>
        </div>
    <div class="navigation-dropdown">
        <div class="navigation_dropdown_links">
            @if(isset($populars))
                @foreach($populars as $popular)
                    @if(isset($news) || isset($one_news))
                        <div class="nav-link">
                            <div class="d-flex">
                                <h6>{{ $popular['title_'.$lang] }}</h6>
                                <a href="{{ asset(''.$url_lang.'/news/'.$popular->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($popular['title_ru'], $translate)) ) ) }}" class="right-icon"></a>
                            </div>
                        </div>
                    @elseif(isset($questions) || isset($question))
                        <div class="nav-link">
                            <div class="d-flex">
                                <h6>{{ $popular['title_'.$lang] }}</h6>
                                <a href="{{ asset(''.$url_lang.'/questions/'.$popular->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($popular['title_ru'], $translate)) ) ) }}" class="right-icon"></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            @if(isset($apartment))
                @if(count($apartment->sliders))
                    <div class="nav-link">
                        <a href="#photoPosition">@lang('main.photo')</a>
                    </div>
                @endif
                <div class="nav-link">
                    <a href="#advantagePosition">@lang('main.advantage')</a>
                </div>
                @if(!empty($apartment->description))
                    <div class="nav-link">
                        <a href="#descriptionPosition">@lang('main.description')</a>
                    </div>
                @endif
                @if(!empty($apartment->video->url))
                    <div class="nav-link">
                        <a href="#videoPosition">@lang('main.video')</a>
                    </div>
                @endif
                @if(!empty($apartment->map->url))
                    <div class="nav-link">
                        <a href="#locationPosition">@lang('main.location')</a>
                    </div>
                @endif
            @elseif(isset($project))
                @if(!empty($project->video))
                    <div class="nav-link">
                        <a href="#videoPosition">@lang('main.video')</a>
                    </div>
                @endif
                <div class="nav-link">
                    <a href="#advantagePosition">@lang('main.advantage')</a>
                </div>
                @if(!empty($project->description))
                    <div class="nav-link">
                        <a href="#descriptionPosition">@lang('main.description')</a>
                    </div>
                @endif
                @if(!empty($project->plan))
                    <div class="nav-link">
                        <a href="#3dPlanPosition">@lang('main.3d_plan')</a>
                    </div>
                @endif
                @if(count($project->layoutSlider))
                        <div class="nav-link">
                            <a href="#layoutsPosition">@lang('main.layouts')</a>
                        </div>
                @endif
                @if(!empty($project->infrastructure))
                    <div class="nav-link">
                        <a href="#infrastructurePosition">@lang('main.infrastructure')</a>
                    </div>
                @endif
                @if (count($project->progress))
                    <div class="nav-link">
                        <a href="#apartmentsPosition">@lang('main.apartments')</a>
                    </div>
                @endif
                @if(!empty($project->map->url))
                    <div class="nav-link">
                        <a href="#locationPosition">@lang('main.location')</a>
                    </div>
                @endif
                @if (count($project->apartments) != 0)
                    <div class="nav-link">
                        <a href="#progressTitlePosition">@lang('main.progress_building')</a>
                    </div>
                @endif
                <div class="nav-link">
                    <a href="#reviewsPosition">@lang('main.reviews')</a>
                </div>
            @endif
        </div>
    </div>
</div>


