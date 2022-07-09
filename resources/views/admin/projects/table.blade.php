<div class="box-table-admin">
    <input type="hidden" value="{{ $page }}" name="projects" id="currentPage">
    <input type="hidden" value="{{ $sort_id }}" id="currentSortId">
    <table class="table table-admin">
        <thead>
            <tr>
                <th scope="col">
                    <div class="title-th
                    @if(count($projects) > 10)
                        sort_id
                    @endif
                        ">
                        <span>{{ __('#') }}</span>
                        @if(count($projects) > 10)
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
                        <span>{{ __('Название EN') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название TR') }}</span>
                    </div>
                </th>
                <th scope="col">
                    <div class="title-th">
                        <span>{{ __('Название RU') }}</span>
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

        @foreach($projects as $project)
{{--            @dd($project->images->logo)--}}
            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td><img class="img" src="{{ asset('/upload/projects/logo') }}/{{ $project->images->logo }}" alt=""></td>
                <td>{{ $project->name_en }}</td>
                <td>{{ $project->name_tr }}</td>
                <td>{{ $project->name_ru }}</td>
                <td>{{ $project->city->name_ru }}</td>
                <td>{{ $project->district->name_ru }}</td>
                <td>
                    <div class="button-box">
                        <a target="_blank" href="{{ url('admin/projects/show/'.$project->id) }}">
                            <i style="font-size: 18px" class="fa fa-file" aria-hidden="true"></i>
                        </a>
                        <i class="fa fa-pencil" aria-hidden="true" onclick="getModalAdmin('projects/show?id={{ $project->id }}', this);"></i>
                        <i class="fa fa-trash-o" aria-hidden="true" onclick="getModalAdmin('projects/show?id={{ $project->id }}&delete=1', this);"></i>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    {{ $projects->links() }}
