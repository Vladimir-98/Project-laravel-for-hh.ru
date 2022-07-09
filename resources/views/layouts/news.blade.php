@php
    $lang = app()->getLocale();

    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
@endphp
@if( count($news) != 0 )
    <div class="flex-space-b header-block">
        <h1>
            @if(!empty($page->title['page_title_one_'.$lang]))
                {{ $page->title['page_title_one_'.$lang] }}
            @endif
        </h1>
    </div>
    <div class="catalog-cards">
        <div class="card-grid-one">
            @foreach($news as $news_one)
                <div class="card-faq">
                    <div class="card-header">
                        <div>{!! $news_one['title_'.$lang] !!}</div>
                        <a href="{{ asset(''.$url_lang.'/news/'.$news_one->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($news_one['title_ru'], $translate)) ) ) }}"
                           class="right-icon"></a>
                    </div>
                    <div class="img-text-block">
                        <p class="text-paragraph">
                            <img
                                src="@if($news_one->images->post){{ asset('upload/news') }}/{{ $news_one->images->post }}@else{{ asset('/upload/default_project_catalog.jpg') }}@endif"
                                title="{{$news_one->images->post_alt}}" alt="{{$news_one->images->post_alt}}">
                            {!! mb_strimwidth($news_one['description_'.$lang], 0, 500, "...") !!}
                        </p>
                    </div>
                    <p>{{ date_format($news_one->created_at, 'd.m.Y') }}</p>
                </div>
            @endforeach
            <div class="pagination-area">
                {{ $news->links() }}
            </div>
        </div>
    </div>
@else
    <div class="flex-space-b header-block">
        <h3>{{ ucfirst(__('main.nothing_found')) }}</h3>
    </div>
@endif
