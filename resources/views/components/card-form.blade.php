<div class="card-form">
    <div class="logo-form">
        <img src="{{ asset('/upload/svg/logo-blue.svg') }}" alt="logo sultan_2669" width="80" height="50">
    </div>
{{--    <div class="flex-space-b">--}}
{{--        <span class="title_form">@lang('main.leave_request')</span>--}}
{{--    </div>--}}
    <form action="">
        <div class="form-group">
{{--            <x-label for="nameUser" :value="__('auth.name')"/>--}}
            <label>@lang('auth.name')
            <span class="required">*</span>
            <x-input class="custom_input" type="text" name="name"/>
            </label>

        </div>
        <div class="form-group">
{{--            <x-label for="phone" :value="__('auth.phone_number')"/>--}}
            <label>@lang('auth.phone_number')
            <span class="required">*</span>
            <x-input class="phone custom_input" type="text" name="phone"/>
            </label>
        </div>
        <div class="form-group">
{{--            <x-label for="email" :value="__('auth.email')"/>--}}
            <label>@lang('auth.email')
            <span class="required">*</span>
            <x-input class="custom_input" type="text" name="email"/>
            </label>
        </div>
        <div class="form-group" style="position: relative">
            <x-label for="textMessage" :value="__('main.message')"/>
            <div class="editor text-paragraph contenteditable-form" contenteditable="true" onblur="addDataTextareaForm(this)"></div>
            <label>
                <textarea class="custom_input" name="text" type="text" style="display: none"></textarea>
            </label>

        </div>
        <input type="hidden" name="data-form" value="@yield('data-form')">
        <button class="btn btn-blue">@lang('main.send')</button>
    </form>
</div>
