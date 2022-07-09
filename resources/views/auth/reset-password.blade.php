<x-guest-layout>
    <x-auth-card>
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="auth-errors" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-group">
                <x-label for="email" :value="__('auth.email')" />

                <x-input id="email" type="email" class="custom_input" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-label for="password" :value="__('auth.password_name')" />

                <x-input id="password" class="custom_input" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-label for="password_confirmation" :value="__('auth.confirm_password')" />

                <x-input id="password_confirmation"
                         class="custom_input"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="d-flex">
                <x-button class="btn btn-blue">
                    @lang('auth.reset_password')
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
