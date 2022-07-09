<x-guest-layout>
    <x-auth-card>
    {{--        <x-slot name="logo">--}}
    {{--            <a href="/">--}}
    {{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
    {{--            </a>--}}
    {{--        </x-slot>--}}

    <!-- Validation Errors -->
        <x-auth-validation-errors class="auth-errors" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div class="form-group">
                <x-label for="name" :value="__('auth.name')"/>

                <x-input id="name" class="custom_input" type="text" name="name" :value="old('name')" required autofocus/>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-label for="email" :value="__('auth.email')"/>

                <x-input id="email" class="custom_input" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-label for="password" :value="__('auth.password_name')"/>

                <x-input id="password"
                         class="custom_input"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-label for="password_confirmation" :value="__('auth.confirm_password')"/>

                <x-input id="password_confirmation"
                         class="custom_input"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <div class="d-flex">
                <a class="text-revert" href="{{ route('login') }}">
                    @lang('auth.login')
                </a>

                <x-button class="btn btn-blue">
                    @lang('auth.register')
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
