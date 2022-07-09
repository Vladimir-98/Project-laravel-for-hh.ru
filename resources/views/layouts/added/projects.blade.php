@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp
@foreach($projects as $project)
    <div class="swiper-slide">
        @php
            $urls_arr = [
                'url_en' => $project->id.' residential complex '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' turkey',
                'url_tr' => $project->id.' konut kompleksi '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' türkiye',
                'url_ru' => $project->id.' жилой комплекс '.$project['name_'.$lang].' '.$project->city['name_'.$lang].' турция',
            ];
        @endphp
        <div class="card">
            @if(!empty($project->status))
                <div class="sale-status-project">
                    @if ($project->status == 1)
                        {{ __('main.urgent_sale') }}
                    @endif
                </div>
            @endif
            <div class="card-img">
                <img
                    src="{{ asset('upload/projects/post') }}/{{ $project->images->post }}"
                    width="240" height="240" title="{{ $project->images->post_alt }}"
                    alt="{{ $project->images->post_alt }}">
                <div class="heart">
                    <img class="delete_card_added" data-name="Project" data-id="{{ $project->id }}"
                         @if(session()->has('data.projects') && in_array($project->id, session()->get('data.projects')))
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
                            @isset($project)
                                {!! mb_strimwidth($project['name_'.$lang], 0, 17, "...") !!}
                            @endisset
                        </p>
                        @php
                            if($project->deadline < date('Y/m/d')) {
                                $curr_project = 'old-projects';
                            } else {
                                $curr_project = 'new-projects';
                            }
                        @endphp
                        <a target="_blank" href="{{ asset(''.$url_lang.'/projects/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}" class="btn btn-azure">{{ __('main.more') }}</a>
                    </div>
                    <div class="details-project">
                        <span>{{ $project->city['name_'.$lang] }}{{ __(' :  ') }} {{ $project->district['name_'.$lang] }}</span>
                        <span>{{ ucfirst(__('main.layouts')) }}{{ __(' :  ') }} {{ $project->layouts }}</span>
                        <span>{{ ucfirst(__('main.sea')) }}{{ __(' : ') }} {{ $project->sea }} {{ __('м') }}</span>
                        @if(!empty($project->aidat))<span>{{ ucfirst(__('main.aidat')) }}{{ __(' : ') }} {{ $project->aidat }}</span>@endif
                    </div>
                    <div class="footer">
                        <div class="logo-box">
                            <div class="logo-box">
                                <img
                                    src="@if($project->images->post){{ asset('upload/projects/logo') }}/{{ $project->images->logo }}@else{{ asset('/upload/default_project_logo.png') }}@endif"
                                    title="{{ $project->images->logo_alt }}"
                                    alt="{{ $project->images->logo_alt }}">
                            </div>
                        </div>
                        <p>@lang('main.from') {{ number_format($project->price, 0, '', ' ') }} @lang('main.currency')</p>
                    </div>
                </div>
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



