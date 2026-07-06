<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $property->title }}</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $property->title }}</h1>
                    <p class="text-gray-500">{{ $property->area }}, {{ $property->city }}</p>
                </div>
                @if ($property->is_featured)
                    <span class="text-sm font-medium bg-amber-100 text-amber-800 px-3 py-1 rounded-full">{{ __('Featured') }}</span>
                @endif
            </div>

            <div class="h-64 bg-gray-200 rounded-md flex items-center justify-center text-gray-400 mb-6">
                {{ __('No Image') }}
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6 text-center">
                <div class="bg-gray-50 rounded-md p-3">
                    <div class="text-lg font-semibold">&#8377;{{ number_format($property->price) }}</div>
                    <div class="text-xs text-gray-500 uppercase">{{ $property->type === 'rent' ? __('per month') : __('price') }}</div>
                </div>
                <div class="bg-gray-50 rounded-md p-3">
                    <div class="text-lg font-semibold">{{ $property->bedrooms ?? '-' }}</div>
                    <div class="text-xs text-gray-500 uppercase">{{ __('Bedrooms') }}</div>
                </div>
                <div class="bg-gray-50 rounded-md p-3">
                    <div class="text-lg font-semibold">{{ $property->bathrooms ?? '-' }}</div>
                    <div class="text-xs text-gray-500 uppercase">{{ __('Bathrooms') }}</div>
                </div>
                <div class="bg-gray-50 rounded-md p-3">
                    <div class="text-lg font-semibold">{{ $property->size_sqft ?? '-' }}</div>
                    <div class="text-xs text-gray-500 uppercase">{{ __('Sqft') }}</div>
                </div>
            </div>

            <h3 class="font-semibold text-gray-800 mb-2">{{ __('Description') }}</h3>
            <p class="text-gray-600 mb-6">{{ $property->description }}</p>

            @if ($property->address)
                <p class="text-sm text-gray-500 mb-6">{{ __('Address') }}: {{ $property->address }}</p>
            @endif

            <div class="border-t pt-4">
                <p class="text-sm text-gray-500">{{ __('Listed by') }} <span class="font-medium text-gray-700">{{ $property->user->name }}</span></p>
                @if ($property->user->phone)
                    <p class="text-sm text-gray-500">{{ __('Contact') }}: {{ $property->user->phone }}</p>
                @endif
            </div>
        </div>
    </div>
</x-public-layout>
