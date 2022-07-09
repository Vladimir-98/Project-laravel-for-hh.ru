<x-guest-layout>
    <x-auth-card>
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>--}}
{{--            </a>--}}
{{--        </x-slot>--}}

        <!-- Session Status -->
        <x-auth-session-status class="auth-session" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="auth-errors" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
            <div class="form-group">
                <x-label for="email" :value="__('auth.email')"/>

                <x-input id="email" class="custom_input" type="email" name="email" :value="old('email')" required autofocus/>
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-label for="password" :value="__('auth.password_name')"/>

                <x-input id="password" class="custom_input" type="password" name="password" required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="checkbox">
                <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                <label for="remember_me">
                    <span class="price">@lang('auth.remember_me')</span>
                </label>

            </div>

            <div class="d-flex">
                @if (Route::has('password.request'))
                    <a class="text-revert"
                       href="{{ route('password.request') }}">
                        @lang('auth.forgot_password')
                    </a>
                @endif
                <x-button class="btn btn-blue">
                    @lang('auth.login')
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
