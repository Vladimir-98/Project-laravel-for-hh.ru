<!====== SLIDER =======>
<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">{{ __('редактирование слайдера') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="page-slider" id="pageComponent">
    <form id="adminForm"
          action="@if(count($page->sliders)){{ url('admin/pages/show/update-images') }}@else{{ url('admin/pages/show/add-images') }}@endif"
          method="POST"
          enctype="multipart/form-data">
        @if(count($page->sliders))
            @method('PUT')
        @else
            @csrf
        @endif
        <input type="hidden" value="{{ $page->id }}" name="page-slider" id="currentPage">
        <input type="hidden" value="{{ $page->id }}" name="page_id">
        <input type="hidden" id="currentSortId">
        <div class="box-form-group-img card-grid-five" style="gap: 32px;">
            @if (count($page->sliders))
                @for($i = 0; $i < count($page->sliders); $i++)
                    <div class="form-group-img pt-0 add-block">
                        <label for="image_{{ $i + 1 }}" class="d-flex">
                            <div class="mx-auto">
                                {{ $i + 1 }}{{ __(' - ') }}{{ __('(min 852 x 568)') }}
                                <span class="required" style="color: darkred">*</span>
                            </div>
                            <div class="page-logo">
                                <a href="javascript:void(0)" class="sort_by float-right">
                                    <i style="font-size: 17px" data-id="{{ $page->sliders[$i]->id }}"class=" delete-images fa fa-trash text-danger" aria-hidden="true"></i>
                                    <input type="hidden" name="pages/show/delete-image/" value="{{ $page->sliders[$i]->id }}">
                                </a>
                            </div>
                        </label>
                        <div class="img-box mt-3 mb-3" style="width: 260px; height: 173px; background: url(/upload/pages/slider/{{ $page->sliders[$i]->image_medium }})no-repeat center/cover">
                            <input class="input-img" id="image_{{ $i + 1 }}" type="file" name="image_{{ $i + 1 }}"
                                   onchange="loadImageInput(event, this)">
                        </div>
                        <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                            <label for="image_alt_{{ $i + 1 }}"> {{ __('описание изображения') }} <span
                                    class="required">*</span>
                            </label>
                            <input class="custom_input input_alt" id="image_alt_{{ $i + 1 }}" type="text" name="image_alt_{{ $i + 1 }}"
                                   style="height: 25px; font-size: 12px;"
                                   value="{{ $page->sliders[$i]->image_alt }}">
                            <input type="hidden" value="{{ $page->sliders[$i]->id }}" name="id_{{ $i + 1 }}">
                        </div>
                    </div>
                @endfor
            @endif
        </div>

        <div class="page-logo">
            <a href="javascript:void(0)" class="add-images float-left">
                <i style="font-size: 25px" data-height="173" data-name="pages" class="fa fa-plus-circle text-success" aria-hidden="true"></i>
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

