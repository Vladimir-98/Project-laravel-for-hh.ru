@php
    $lang = app()->getLocale();
    $url_lang = '/' . $lang;
    if ($lang == 'ru') { $url_lang = ''; }
@endphp
@if($reviews)
    @foreach($reviews as $review)
        <div class="flex-space-b">
            <div class="review-info-block">
                <div class="d-flex">
                    <div class="avatar" style="background:
                    @if($review->user->avatar) url({{ asset('upload/avatar') }}/{{ $review->user->avatar }})
                    @else url({{ asset('upload/svg/avatar.svg') }})
                    @endif no-repeat center/cover">
                    </div>
                    <div class="info">
                        <p class="review_title">
                            {{ $review->user->name }}
                        </p>
                        <p class="review_date">{{ date_format($review->created_at, 'd.m.Y') }}</p>
                    </div>
                </div>
                <div class="review-text">
                    <p class="text-paragraph">
                        {!! $review->review !!}
                    </p>
                </div>
                <!--  Review answer-->
                @if(!empty($review->answer))
                    <div class="flex-space-b review_answer">
                        <div class="review-info-block">
                            <div class="d-flex">
                                <div class="avatar" style="background:
                                @if($review->answer->user->avatar) url({{ asset('upload/avatar') }}/{{ $review->answer->user->avatar }})
                                @else url({{ asset('upload/svg/avatar.svg') }})
                                @endif no-repeat center/cover">
                                </div>
                                <div class="info">
                                    <p class="review_title">
                                        {{ __('main.administrator') }}
                                    </p>
                                </div>
                            </div>
                            <div class="review-text">
                                <p class="text-paragraph">
                                    {!! $review->answer->answer !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <hr>
    @endforeach
@endif
@if($reviews_length)
    @php
        if ($reviews[0]->review_gable_type == 'App\Models\Admin\Project') {
            $type = 'Project';
        } elseif ($reviews[0]->review_gable_type == 'App\Models\Admin\Page'){
            $type = 'Page';
        }
        $review_id = $reviews[0]->review_gable_id;
    @endphp
    <div data-name="{{ url(''.$url_lang.'/reviews?quantity=') }}{{ $quantity }}{{ __('&review_id=') }}{{ $review_id }}{{ __('&type='.$type) }}" class="btn btn-blue add-reviews">@lang('main.show_more')</div>
@endif
