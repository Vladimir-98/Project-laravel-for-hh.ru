@php
    $lang = app()->getLocale();
    $url_lang = '/'.$lang; if ( $lang == 'ru' ) { $url_lang = ''; }
    $lang === 'ru' ? $lang_canonical = '' : $lang_canonical = $lang.'/';
@endphp
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
                    <img class="delete_card_added" data-name="Apartments" data-id="{{ $apartment->id }}"
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
                        <a target="_blank" href="{{ asset(''.$url_lang.'/apartments/'.preg_replace('/(\s+)/i', '-', mb_strtolower(strtr($urls_arr['url_ru'], $translate)) ) ) }}" class="btn-azure">{{ __('main.more') }}</a>
                    </div>
                    <div class="details-project">
                        <span>{{ $apartment->city['name_'.$lang] }}{{ __(' : ') }} {{ $apartment->district['name_'.$lang] }}</span>
                        <span>{{ ucfirst(__('main.layout')) }}{{ __(' :  ') }} {{ $apartment->layout }}{{ __(' + 1 ') }}</span>
                        <span>{{ ucfirst(__('main.quadrature')) }}{{ __(' : ') }} {{ $apartment->quadrature }} {{ __('м') }}&#178</span>
                        <span>{{ ucfirst(__('main.sea')) }}{{ __(' : ') }} {{ $apartment->sea }} {{ __('м') }}</span>
                        <span>{{ ucfirst(__('main.floor')) }}{{ __(' : ') }} {{ $apartment->floor }}{{ __(' / ') }}{{ $apartment->floors }}</span>
                    </div>
                    <div class="footer flex-space-b">
                        <p class="price-home">{{ number_format($apartment->price, 0, '', ' ') }} @lang('main.currency')</p>
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



