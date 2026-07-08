@php
    $img = !empty($property->images) ? $property->images[0] : 'https://picsum.photos/seed/property-'.$property->id.'/640/480';
@endphp
<a href="{{ route('properties.show', $property) }}" class="group block bg-white rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
    <div class="relative h-48 overflow-hidden">
        <img src="{{ $img }}" alt="{{ $property->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

        <div class="absolute top-3 left-3 flex gap-1.5">
            @if ($property->is_featured)
                <span class="text-[11px] font-semibold bg-brand-600 text-white px-2.5 py-1 rounded-full">{{ __('Premium') }}</span>
            @else
                <span class="text-[11px] font-semibold bg-emerald-500 text-white px-2.5 py-1 rounded-full">{{ __('Verified') }}</span>
            @endif
        </div>

        <button type="button" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-gray-500 hover:text-red-500">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
        </button>
    </div>
    <div class="p-4">
        <h3 class="font-semibold text-gray-800 truncate">{{ $property->title }}</h3>
        <p class="text-sm text-gray-500 mb-3">{{ $property->area }}, {{ $property->city }}</p>
        <div class="flex items-center justify-between">
            <span class="text-brand-600 font-bold">
                &#8377;{{ number_format($property->price) }}{{ $property->type === 'rent' ? '/mo' : '' }}
            </span>
            <span class="text-sm font-medium text-brand-600 group-hover:underline">{{ __('View Details') }}</span>
        </div>
    </div>
</a>
