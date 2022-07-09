<!====== IMAGES =======>

<div class="header-block ml-3 mb-5">
    <h3 class="mt-5">{{ $page->name_page }}</h3>
    <h5 class="mt-2">{{ __('редактирование изображения') }}</h5>
</div>
<div class="card-form">
    <input type="hidden" name="image" id="pageComponent">
    <input type="hidden" value="{{ $page->id }}" name="image" id="currentPage">
    <form id="adminForm"
          action="@if(!empty($page->image)){{ url('admin/pages/show/update-image') }}@else{{ url('/admin/pages/show/add-image') }}@endif"
          method="POST"
          enctype="multipart/form-data">
            @if($page->image)
            <input type="hidden" name="image_id" value="{{ $page->image->id }}">
                @method('PUT')
            @else
                @csrf
            @endif
        <input type="hidden" value="{{ $page->id }}" name="page_id">
        <input type="hidden" value="{{ $page->id }}" name="image" id="currentPage">
        <input type="hidden" id="currentSortId">
        <div class="box-form-group-img card-grid-trio project_slider-grid" style="gap: 0;">
            <div class="add-block">
                <div class="form-group-img pt-0 ">
                    <label for="image" class="d-flex">
                        <div class="mx-auto">
                            {{ __('(min 850 x 560)') }}
                            <span class="required" style="color: darkred">*</span>
                        </div>
                    </label>
                    <div class="img-box mt-3 mb-3" style="width: 100%; background:
                         @isset($page->image->image)
                             url(/upload/pages/image/{{ $page->image->image }})
                         @else
                             url(/upload/default_project_catalog.jpg)
                         @endisset
                             no-repeat center/cover"><input class="input-img" id="image" type="file" name="image" onchange="loadImageInput(event, this)">
                    </div>

                    <div class="form-group pl-3 pr-3" style="position: relative; font-size: 12px">
                        <label for="image_alt"> {{ __('описание изображения') }}
                            <span class="required">*</span>
                        </label>
                        <input class="custom_input input_alt" id="image_alt" type="text"
                               name="image_alt"
                               style="height: 25px; font-size: 12px;"
                               @isset($page->image->image_alt)value="{{ $page->image->image_alt }}" @endisset
                        >
                    </div>
                </div>
            </div>
        </div>
        <!====== FOOTER BUTTON ======>
        <div class="footer-modal">
            <div class="d-flex">
{{--                @if(!empty($page->plan))--}}
{{--                    <button data-name="city"  type="button" class="btn btn-danger" onclick="getDeleteModalAdmin('image-delete', @if(!empty($page->image)){{ $page->image->id }})@endif;">--}}
{{--                        {{ __('удалить') }}--}}
{{--                    </button>--}}
{{--                @endif--}}
                <button data-name="city" type="button" class="btn btn-blue form_btn">
                    {{ __('сохранить') }}
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    .card-form .box-form-group-img .form-group-img .img-box {
        height: 560px;
    }
    @media (max-width: 850px) {
        .card-form .box-form-group-img .form-group-img .img-box {
            height: 237px;
        }
    }
</style>
