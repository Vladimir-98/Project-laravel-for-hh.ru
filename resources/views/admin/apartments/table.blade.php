<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="apartments" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($apartments) > 10)
                        sort_id
                    @endif
                        ">
                        <span>{{ __('#') }}</span>
                        @if(count($apartments) > 10)
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
                        <span>{{ __('Планировка') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Этаж') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Цена') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Город') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Район') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Действие') }}</span>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>

        @foreach($apartments as $apartment)
{{--            @dd($project->images->logo)--}}
            <tr>
                <th scope="row">{{ $apartment->id }}</th>
                <td><img class="img"  src="/upload/apartments/post/{{ $apartment->images->post_small }}" alt=""></td>
                <td>{{ $apartment->layout }}{{ __(' + 1') }}</td>
                <td>{{ $apartment->floor }}{{ __(' / ') }}{{ $apartment->floors }}</td>
                <td>{{ $apartment->price }} @lang('main.currency')</td>
                <td>{{ $apartment->city->name_ru }}</td>
                <td>{{ $apartment->district->name_ru }}</td>
                <td>
                    <div class="button-box">
                        <a target="_blank" href="{{ url('admin/apartments/show/'.$apartment->id) }}">
                            <i style="font-size: 18px" class="fa fa-file" aria-hidden="true"></i>
                        </a>
                        <i class="fa fa-pencil" aria-hidden="true" onclick="getModalAdmin('apartments/show?id={{ $apartment->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('apartments/show?id={{ $apartment->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $apartments->links() }}
