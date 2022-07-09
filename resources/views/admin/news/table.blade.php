<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="news" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
        <tr>
            <th scope="col">
                <div class="title-th
                    @if(count($news) > 10)
                        sort_id
                    @endif
                    ">
                    <span>{{ __('#') }}</span>
                    @if(count($news) > 10)
                        <i class="fa fa-sort-amount-{{ $sort_id }}" aria-hidden="true"></i>
                    @endif
                </div>
            </th>
            <th scope="col">
                <div class="title-th">
                    <span>{{ __('Изображение') }}</span>
                </div>
            </th>
            <th scope="col">
                <div class="title-th">
                    <span>{{ __('новость RU') }}</span>
                </div>
            </th>
            <th scope="col">
                <div class="title-th">
                    <span>{{ __('Описание RU') }}</span>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td><img class="img" src="/upload/news/{{ $post->images->post_small }}" alt=""></td>
                <td>{{ $post->title_ru }}</td>
                <td style="font-size: 13px">
                    {!! mb_strimwidth($post->description_ru, 0, 150, "...") !!}
                </td>
                <td>
                    <div class="button-box">
                        <i class="fa fa-pencil" aria-hidden="true"
                           onclick="getModalAdmin('news/show?id={{ $post->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true"
                           onclick="getModalAdmin('news/show?id={{ $post->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $news->links() }}
