<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="districts" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($districts) > 10)
                        sort_id
                    @endif
                    ">
                        <span>{{ __('#') }}</span>
                        @if(count($districts) > 10)
                            <i class="fa fa-sort-amount-{{ $sort_id }}" aria-hidden="true"></i>
                        @endif
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название района EN') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название района TR') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название района RU') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Город') }}</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($districts as $district)
            <tr>
                <th scope="row">{{ $district->id }}</th>
                <td>{{ $district->name_en }}</td>
                <td>{{ $district->name_tr }}</td>
                <td>{{ $district->name_ru }}</td>
                <td>{{ $district->city->name_ru }}</td>
                <td>
                    <div class="button-box">
                        <i class="fa fa-pencil" aria-hidden="true" onclick="getModalAdmin('districts/show?id={{ $district->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('districts/show?id={{ $district->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $districts->links() }}
