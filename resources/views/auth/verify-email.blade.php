<x-guest-layout>
    <x-auth-card>
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

        <div class="auth-session">
            @lang('auth.email_confirmation')
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="auth-session">
                @lang('auth.new_link_message')
            </div>
        @endif

        <div class="d-flex">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button class="btn btn-blue">
                        @lang('auth.resend')
                    </x-button>
                </div>
            </form>

            <form style="margin-left: auto" method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-blue">
                    @lang('auth.logout')
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
