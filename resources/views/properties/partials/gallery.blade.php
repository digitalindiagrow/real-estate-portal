@php
    $images = !empty($property->images) ? $property->images : ['https://picsum.photos/seed/property-'.$property->id.'/1200/800'];
@endphp

<div x-data="{ active: 0, images: {{ Js::from($images) }} }">
    <div class="relative rounded-xl overflow-hidden h-64 sm:h-96 bg-gray-100">
        <img :src="images[active]" class="w-full h-full object-cover" alt="{{ $property->title }}">

        @if ($property->is_featured)
            <span class="absolute top-3 left-3 text-xs font-semibold bg-brand-600 text-white px-2.5 py-1 rounded-full">{{ __('Featured') }}</span>
        @endif

        <span class="absolute bottom-3 right-3 text-xs bg-black/60 text-white px-2 py-1 rounded-full" x-text="(active + 1) + ' / ' + images.length"></span>

        <template x-if="images.length > 1">
            <div>
                <button type="button" @click="active = (active - 1 + images.length) % images.length"
                    class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button type="button" @click="active = (active + 1) % images.length"
                    class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </template>
    </div>

    <template x-if="images.length > 1">
        <div class="grid grid-cols-5 gap-2 mt-2">
            <template x-for="(img, i) in images.slice(0, 5)" :key="i">
                <button type="button" @click="active = i" class="relative h-16 sm:h-20 rounded-lg overflow-hidden">
                    <img :src="img" class="w-full h-full object-cover" :class="{ 'opacity-60': active !== i }">
                    <span x-show="i === 4 && images.length > 5" x-text="'+' + (images.length - 5) + ' Photos'"
                        class="absolute inset-0 bg-black/60 text-white text-xs font-semibold flex items-center justify-center"></span>
                </button>
            </template>
        </div>
    </template>
</div>
