<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('We emailed a 6-digit verification code to your email address. Enter it below to verify your account.') }}
    </div>

    @if (session('status') === 'otp-resent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification code has been sent to your email address.') }}
        </div>
    @endif

    <x-input-error :messages="$errors->get('code')" class="mb-4" />

    <form method="POST" action="{{ route('verification.verify.otp') }}" class="mb-4">
        @csrf
        <x-input-label for="code" :value="__('Verification Code')" />
        <x-text-input id="code" name="code" type="text" inputmode="numeric" maxlength="6"
            class="mt-1 block w-full tracking-widest text-center text-lg" autofocus required />

        <div class="mt-4">
            <x-primary-button>{{ __('Verify') }}</x-primary-button>
        </div>
    </form>

    <div class="flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Resend code') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
