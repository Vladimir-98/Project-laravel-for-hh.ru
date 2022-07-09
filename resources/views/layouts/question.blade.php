@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }

@endphp
@if( count($questions) != 0 )
    <div class="flex-space-b header-block">
        <h1>
            @if(!empty($page->title['page_title_one_'.$lang]))
                {{ $page->title['page_title_one_'.$lang] }}
            @endif
        </h1>
    </div>
    <div class="catalog-cards">
        <div class="card-grid-two">
            @foreach($questions as $question)
                <div class="card-faq">
                    <div class="card-header">
                        <h4>{{ mb_strimwidth($question['title_'.$lang], 0, 30, "...") }}</h4>
                        <a href="{{ asset(''.$url_lang.'/questions/'.$question->id.'-'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($question['title_ru'], $translate)) ) ) }}"
                           class="right-icon"></a>
                    </div>
                    <p class="text-paragraph">
                        {!! mb_strimwidth($question['description_'.$lang], 0, 150, "...") !!}
                    </p>
                </div>
            @endforeach
        </div>
        <div class="pagination-area" style="margin-top: 40px">
            {{ $questions->links() }}
        </div>
    </div>
@else
    <div class="flex-space-b header-block">
        <h3>{{ ucfirst(__('main.nothing_found')) }}</h3>
    </div>
@endif
