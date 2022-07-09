<x-guest-layout>
    <x-auth-card>
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

        <div class="auth-session">
            @lang('auth.link_reset_password')
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="auth-session" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="auth-errors" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <!-- Email Address -->
            <div class="form-group">
                <x-label for="email" :value="__('auth.email')" />

                <x-input id="email" class="custom_input" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <div class="d-flex">
                <x-button class="btn btn-blue">
                    @lang('auth.reset_password')
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
