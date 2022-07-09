<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="reviews" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($reviews) > 10)
                        sort_id
                    @endif
                        ">
                        <span>{{ __('#') }}</span>
                        @if(count($reviews) > 10)
                            <i class="fa fa-sort-amount-{{ $sort_id }}" aria-hidden="true"></i>
                        @endif
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Страница') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Отзыв') }}</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <th scope="row">{{ $review->id }}</th>
                <td>
                    @if ($review->review_gable_type == 'App\Models\Admin\Project')
                    {{ __('Проект "') }}{{ $review->project->name_ru }}{{ __('"') }}
                    @elseif($review->review_gable_type == 'App\Models\Admin\Page')
                    {{ __('Страница "') }}{{ $review->page->name_page }}{{ __('"') }}
                    @endif
                </td>
                <td @if(!$review->status) id="active_{{ $review->id }}" @endif style="font-size: 13px; @if(!$review->status) font-weight: bold; color: #000000; @endif">
                    {!! mb_strimwidth($review->review, 0, 150, "...") !!}
                </td>
                <td>
                    <div class="button-box">
                        <i class="fa fa-pencil" @if(!$review->status) data-id="active_{{ $review->id }}" @endif aria-hidden="true" onclick="getModalAdmin('reviews/show?id={{ $review->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('reviews/show?id={{ $review->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $reviews->links() }}
