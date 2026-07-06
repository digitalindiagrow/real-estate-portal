<a href="{{ route('properties.show', $property) }}" class="block bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden">
    <div class="h-40 bg-gray-200 flex items-center justify-center text-gray-400">
        {{ __('No Image') }}
    </div>
    <div class="p-4">
        <div class="flex items-center justify-between mb-1">
            <h3 class="font-semibold text-gray-800">{{ $property->title }}</h3>
            @if ($property->is_featured)
                <span class="text-xs font-medium bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full">{{ __('Featured') }}</span>
            @endif
        </div>
        <p class="text-sm text-gray-500 mb-2">{{ $property->area }}, {{ $property->city }}</p>
        <div class="flex items-center justify-between">
            <span class="text-indigo-600 font-semibold">
                &#8377;{{ number_format($property->price) }}{{ $property->type === 'rent' ? '/mo' : '' }}
            </span>
            <span class="text-xs uppercase text-gray-500">{{ $property->type }}</span>
        </div>
    </div>
</a>
