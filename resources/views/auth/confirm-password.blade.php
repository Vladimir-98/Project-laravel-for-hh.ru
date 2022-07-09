<x-guest-layout>
    <x-auth-card>
        {{--        <x-slot name="logo">--}}
        {{--            <a href="/">--}}
        {{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
        {{--            </a>--}}
        {{--        </x-slot>--}}

        <div class="auth-session">
            @lang('auth.please_confirm_password')
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="auth-errors" :errors="$errors"/>

        <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
            <div class="form-group">
                <x-label for="password" :value="@lang('auth.password_name')"/>

                <x-input id="password"
                         class="custom_input"
                         type="password"
                         name="password"
                         required autocomplete="current-password"/>
            </div>

            <div class="d-flex">
                <x-button class="btn btn-blue">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
