<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="cities" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($cities) > 10)
                        sort_id
                    @endif
                        ">
                        <span>{{ __('#') }}</span>
                        @if(count($cities) > 10)
                            <i class="fa fa-sort-amount-{{ $sort_id }}" aria-hidden="true"></i>
                        @endif
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название города EN') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название города TR') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название города RU') }}</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($cities as $city)
            <tr>
                <th scope="row">{{ $city->id }}</th>
                <td>{{ $city->name_en }}</td>
                <td>{{ $city->name_tr }}</td>
                <td>{{ $city->name_ru }}</td>
                <td>
                    <div class="button-box">
                        <i class="fa fa-pencil" aria-hidden="true" onclick="getModalAdmin('cities/show?id={{ $city->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('cities/show?id={{ $city->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{ $cities->links() }}
