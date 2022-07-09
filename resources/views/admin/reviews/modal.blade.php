<div id="my_modal" class="modal">
        <input type="hidden" id="notification" value="{{ $notification }}">
    <div class="modal_content container">
        <span class="close_modal_window close_modal">{{ __('×') }}</span>
        <div class="card-form">
            @if(!$delete)
                <form id="adminForm"
                      action="@isset($review){{ url('admin/reviews/update') }}@endisset"
                      method="POST">
                    @isset($review)
                        <input type="hidden" name="id" value="{{ $review->id }}">
                        @method('PUT')
                    @else
                        @csrf
                    @endisset
                    <!=======Описание EN========>
                    <div class="form-group" style="position: relative">
                        <label for="review">
                            {{ __('Отзыв') }}
                            <span class="required">*</span>
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="textEdit">@isset($review){!! $review->review !!}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="review" id="review" type="text" style="display: none">
                            @isset($review){{ $review->review }}@endisset
                        </textarea>
                    </div>
                        <input type="hidden" name="user_id" value="@isset($review){{ $review->user_id }}@endisset">
                    <hr class="mt-4 mb-4">

                    <div class="form-group" style="position: relative">
                        <label for="answer">
                            {{ __('Ответ') }}
                        </label>
                        @include('layouts.admin.layouts.contenteditable')
                        <div class="editor text-paragraph" contenteditable="true" onblur="addDataTextarea(this)">
                            <div class="textEdit">@isset($review->answer){!! $review->answer->answer !!}@else{{ __('Ответ...') }}@endisset</div>
                        </div>
                        <textarea class="custom_input" name="answer" id="answer" type="text" style="display: none">
                            @isset($review->answer){!! $review->answer->answer !!}@endisset
                        </textarea>
                    </div>
                        @isset($review->answer)
                            <input type="hidden" name="answer_id" value="{{ $review->answer->id }}">
                        @endisset
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button data-name="city" type="button" class="btn btn-blue form_btn">
                                {{ __('сохранить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <form id="adminForm" action="{{ url('admin/reviews/destroy') }}" method="POST">
                    <input type="hidden" name="id" value="{{ $review->id }}">
                    <input class="custom_input" name="review_delete" id="review_delete" type="hidden" value="{{ mb_strimwidth($review->review, 0, 20, "...") }}">
                    @method('DELETE')
                    <h3>{{ __('Вы точно хотите удалить') }} {{ mb_strimwidth($review->review, 0, 20, "...") }}{{ __('?') }}</h3>
                    <div class="footer-modal">
                        <div class="d-flex">
                            <button type="button" class="btn btn-white close_modal">
                                {{ __('отмена') }}
                            </button>
                            <button type="button" class="btn btn-danger form_btn">
                                {{ __('удалить') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
