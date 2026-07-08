@php
    $img = $reel->thumbnail_path ? Storage::url($reel->thumbnail_path) : 'https://picsum.photos/seed/reel-'.$reel->id.'/400/500';
@endphp
<a href="{{ route('reels.index') }}" class="relative shrink-0 w-40 sm:w-48 h-56 sm:h-64 rounded-xl overflow-hidden group">
    <img src="{{ $img }}" alt="{{ $reel->property->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>

    <span class="absolute inset-0 flex items-center justify-center">
        <span class="w-10 h-10 rounded-full bg-white/90 flex items-center justify-center">
            <svg class="w-4 h-4 text-midnight-950 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M6 4l12 6-12 6V4z"/></svg>
        </span>
    </span>

    <div class="absolute bottom-0 left-0 right-0 p-3">
        <p class="text-white text-sm font-semibold truncate">{{ $reel->property->title }}</p>
        <p class="text-gray-300 text-xs truncate">{{ $reel->property->area }}, {{ $reel->property->city }}</p>
        <p class="text-white text-xs font-semibold mt-0.5">&#8377;{{ number_format($reel->property->price) }}</p>
    </div>
</a>
