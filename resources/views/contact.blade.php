<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Contact Us') }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-lg shadow p-6 space-y-3 text-gray-700">
            <p>{{ __('We would love to hear from you.') }}</p>
            <p><span class="font-medium">{{ __('Email') }}:</span> support@realestate.test</p>
            <p><span class="font-medium">{{ __('Phone') }}:</span> +91 98765 43210</p>
            <p><span class="font-medium">{{ __('Address') }}:</span> {{ __('123 Business Park, Mumbai, India') }}</p>
        </div>
    </div>
</x-public-layout>
