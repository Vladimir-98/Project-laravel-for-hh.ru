<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="questions" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($questions) > 10)
                        sort_id
                    @endif
                        ">
                        <span>{{ __('#') }}</span>
                        @if(count($questions) > 10)
                            <i class="fa fa-sort-amount-{{ $sort_id }}" aria-hidden="true"></i>
                        @endif
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Вопрос RU') }}</span>
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
        @foreach($questions as $question)
            <tr>
                <th scope="row">{{ $question->id }}</th>
                <td>{{ $question->title_ru }}</td>
                <td style="font-size: 13px">
                    {!! mb_strimwidth($question->description_ru, 0, 150, "...") !!}
                </td>
                <td>
                    <div class="button-box">
                        <i class="fa fa-pencil" aria-hidden="true" onclick="getModalAdmin('questions/show?id={{ $question->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('questions/show?id={{ $question->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $questions->links() }}
