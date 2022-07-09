@if(count($cities[0]->districts) == 0)
    <div class="form-group" style="position: relative">
        <h4 style="color: red">{{ __('Чтобы добавить проект, нужно загрузить хотя бы один район!') }}</h4>
    </div>
@else
    <div class="form-group" style="position: relative">
        <label for="district_id">
            {{ __('Выбрать район') }}
            <span class="required">*</span>
        </label>
        {{--        @dd($project->district->id)--}}
        <select class="custom_input" name="district_id" id="district_id" type="text">
            @if($districts)
                @foreach($districts as $district)
                    <option
                        @if(isset($project))
                        @if($project->district->id === $district->id){{__('selected')}}@endif
                        @endif
                        @if(isset($apartments))
                        @if($apartments->district->id === $district->id){{__('selected')}}@endif
                        @endif
                        value="{{ $district->id }}">{{ $district->name_ru }}</option>
                @endforeach
            @else
                @foreach($cities[0]->districts as $district)
                    <option
                        value="{{ $district->id }}">{{ $district->name_ru }}</option>
                @endforeach
            @endif

        </select>
    </div>
@endif

