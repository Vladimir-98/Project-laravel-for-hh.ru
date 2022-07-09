@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
@endphp

@if( count($projects) != 0 )
    <div class="flex-space-b header-block">
        <h1>
            @if(!empty($page->title['page_title_one_'.$lang]))
                {{ $page->title['page_title_one_'.$lang] }}
            @endif
            @if(!empty($city))
                {{ __(' - ') }}{{ $city['name_'.$lang] }}
            @endif
            @if(!empty($district))
                {{ __(' (') }}{{ $district['name_'.$lang] }}{{__(')')}}
            @endif
        </h1>
        <div class="d-flex">
            <div class="page-logo">
                <span>@lang('main.price')</span>
                <span class="sort_by">
                    <img data-name="priceFilter" src="@if($desc_price === 'desc'){{ asset('/upload/svg/up-sort.svg') }}@else{{ asset('upload/svg/down-sort.svg') }}@endif"  alt="sort_price">
                </span>
            </div>
        </div>
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
            @endforeach
        </div>
        <div class="pagination-area">
            {{ $projects->links() }}
        </div>
    </div>
@else
    <div class="flex-space-b header-block">
        <h3>{{ ucfirst(__('main.nothing_found')) }}</h3>
    </div>
@endif
