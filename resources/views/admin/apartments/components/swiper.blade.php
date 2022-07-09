<!====== SWIPER =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ __('Квартира ') }}{{ $apartment->layout }}{{ __('+1 - ') }}  {{ $apartment->city->name_ru }}{{__(' (')}}{{ $apartment->district->name_ru }}{{__(')')}}</h3>
    <h5 class="mt-2">{{ __('слайдер') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="slider" id="pageComponent">
    <form id="adminForm"
          action="@if(count($apartment->sliders)){{ url('admin/apartments/update-images') }}@else{{ url('admin/apartments/add-images') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if(count($apartment->sliders))
            @method('PUT')
        @else
            @csrf
        @endif

        <input type="hidden" value="{{ $apartment->id }}" name="slider" id="currentPage">
        <input type="hidden" value="{{ $apartment->id }}" name="apartment_id">
        <input type="hidden" id="currentSortId">
        <div class="box-form-group-img card-grid-five" style="gap: 32px;">
            @if (count($apartment->sliders))
                @for($i = 0; $i < count($apartment->sliders); $i++)
                    <div class="form-group-img pt-0 add-block">
                        <label for="image_{{ $i + 1 }}" class="d-flex">
                            <div class="mx-auto">
                                {{ $i + 1 }}{{ __(' - ') }}{{ __('(min 852 x 568)') }}
                                <span class="required" style="color: darkred">*</span>
                            </div>
                            <div class="page-logo">
                                <a href="javascript:void(0)" class="sort_by float-right">
                                    <i style="font-size: 17px" data-id="{{ $apartment->sliders[$i]->id }}"class=" delete-images fa fa-trash text-danger" aria-hidden="true"></i>
                                    <input type="hidden" name="apartments/delete-image/" value="{{ $apartment->sliders[$i]->id }}">
                                </a>
                            </div>
                        </label>
                        <div class="img-box mt-3 mb-3" style="width: 260px; height: 173px; background: url(/upload/apartments/slider/{{ $apartment->sliders[$i]->image_medium }})no-repeat center/cover">
                            <input class="input-img" id="image_{{ $i + 1 }}" type="file" name="image_{{ $i + 1 }}"
                                   onchange="loadImageInput(event, this)">
                        </div>
                        <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                            <label for="image_alt_{{ $i + 1 }}"> {{ __('описание изображения') }} <span
                                    class="required">*</span>
                            </label>
                            <input class="custom_input input_alt" id="image_alt_{{ $i + 1 }}" type="text" name="image_alt_{{ $i + 1 }}"
                                   style="height: 25px; font-size: 12px;"
                                   value="{{ $apartment->sliders[$i]->image_alt }}">
                            <input type="hidden" value="{{ $apartment->sliders[$i]->id }}" name="id_{{ $i + 1 }}">
                        </div>
                    </div>
                @endfor
            @endif
        </div>

        <div class="page-logo">
            <a href="javascript:void(0)" class="add-images float-left">
                <i style="font-size: 25px" data-height="173" data-name="apartments" class="fa fa-plus-circle text-success" aria-hidden="true"></i>
            </a>
        </div>

        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
                <button data-name="city" type="button" class="btn btn-blue form_btn">
                    {{ __('загрузить') }}
                </button>
            </div>
        </div>
    </form>
</div>

