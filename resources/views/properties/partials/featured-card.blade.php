@php
    $img = !empty($property->images) ? $property->images[0] : 'https://picsum.photos/seed/featured-'.$property->id.'/640/480';
@endphp
<div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
    <a href="{{ route('properties.show', $property) }}" class="block relative h-44 overflow-hidden">
        <img src="{{ $img }}" alt="{{ $property->title }}" class="w-full h-full object-cover">
        <span class="absolute top-3 left-3 text-[11px] font-semibold {{ $property->is_featured ? 'bg-brand-600' : 'bg-emerald-500' }} text-white px-2.5 py-1 rounded-full">
            {{ $property->is_featured ? __('Premium') : __('Verified') }}
        </span>
        <button type="button" class="absolute top-3 right-3 w-8 h-8 rounded-full bg-white/90 flex items-center justify-center text-gray-500 hover:text-red-500">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
        </button>
    </a>
    <div class="p-4">
        <h3 class="font-semibold text-gray-800 truncate">{{ $property->title }}</h3>
        <p class="text-sm text-gray-500">{{ $property->area }}, {{ $property->city }}</p>
        <p class="text-xs text-gray-400 mb-2">
            {{ $property->bedrooms ? $property->bedrooms.' BHK • ' : '' }}{{ str_replace('_', ' ', ucfirst($property->category)) }}{{ $property->size_sqft ? ' • '.number_format($property->size_sqft).' Sq.Ft.' : '' }}
        </p>
        <p class="text-brand-600 font-bold mb-3">&#8377;{{ number_format($property->price) }}{{ $property->type === 'rent' ? '/mo' : '' }}</p>
        <a href="{{ route('properties.show', $property) }}" class="block text-center bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2 rounded-lg">
            {{ __('View Details') }}
        </a>
    </div>
</div>
