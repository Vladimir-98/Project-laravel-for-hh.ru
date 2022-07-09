{{--Не используется--}}

<div class="form-group" style="position: relative">
    <label for="project_id">
        {{ __('Выбрать проект') }}
        <span class="required">*</span>
    </label>
    <select class="custom_input" name="project_id" id="project_id" type="text">
        @if($districts)
            @foreach($districts as $district)
                <option
                    @isset($project)
                    @if($project->district->id === $district->id){{__('selected')}}@endif
                    @endisset
                    value="{{ $district->id }}">{{ $district->name_ru }}</option>
            @endforeach
        @else
            <option value="">{{ __('не выводить') }}</option>
            @foreach($cities[0]->districts[0]->projects as $project)
                <option value="{{ $project->id }}">{{ $project->name_ru }}</option>
            @endforeach
        @endif

    </select>
</div>

