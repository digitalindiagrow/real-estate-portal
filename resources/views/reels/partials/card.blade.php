@php
    $liked = $reel->isLikedBy(auth()->user());
    $whatsapp = $reel->user->phone ? preg_replace('/\D/', '', $reel->user->phone) : null;
@endphp

<div class="bg-white rounded-lg shadow overflow-hidden" x-data="{ playing: false }">
    <div class="relative h-56 bg-gray-900">
        <template x-if="!playing">
            <button type="button" @click="playing = true" class="absolute inset-0 w-full h-full flex items-center justify-center">
                @if ($reel->thumbnail_path)
                    <img src="{{ Storage::url($reel->thumbnail_path) }}" class="absolute inset-0 w-full h-full object-cover opacity-80" alt="">
                @endif
                <span class="relative z-10 w-14 h-14 rounded-full bg-white/90 flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-800 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M6 4l12 6-12 6V4z"/></svg>
                </span>
            </button>
        </template>
        <template x-if="playing">
            <video controls autoplay preload="metadata" class="absolute inset-0 w-full h-full object-cover"
                @if ($reel->thumbnail_path) poster="{{ Storage::url($reel->thumbnail_path) }}" @endif>
                <source src="{{ Storage::url($reel->video_path) }}">
            </video>
        </template>

        <div class="absolute top-2 left-2 flex gap-1">
            @if ($reel->is_featured)
                <span class="text-xs font-medium bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full">{{ __('Featured') }}</span>
            @endif
            @if ($reel->isNew())
                <span class="text-xs font-medium bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full">{{ __('New') }}</span>
            @endif
        </div>
        @if ($reel->duration_seconds)
            <span class="absolute bottom-2 right-2 text-xs bg-black/70 text-white px-1.5 py-0.5 rounded">
                {{ sprintf('%d:%02d', intdiv($reel->duration_seconds, 60), $reel->duration_seconds % 60) }}
            </span>
        @endif
    </div>

    <div class="p-4">
        <h3 class="font-semibold text-gray-800">{{ $reel->property->title }}</h3>
        <p class="text-sm text-gray-500 mb-2">{{ $reel->property->area }}, {{ $reel->property->city }}</p>
        <p class="text-indigo-600 font-semibold mb-3">
            &#8377;{{ number_format($reel->property->price) }}{{ $reel->property->type === 'rent' ? '/mo' : '' }}
        </p>

        <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
            <div class="flex items-center gap-3">
                <form method="POST" action="{{ route('reels.like', $reel) }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 {{ $liked ? 'text-red-600' : 'text-gray-500' }}">
                        <span>&hearts;</span> {{ $reel->likes_count }}
                    </button>
                </form>
                <span>&#128172; {{ $reel->comments_count }}</span>
            </div>
            @if ($whatsapp)
                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="text-green-600 font-medium">WhatsApp</a>
            @endif
        </div>

        <div class="flex items-center gap-1 text-sm text-gray-600 mb-3">
            <span>{{ $reel->user->name }}</span>
            @if ($reel->user->is_verified)
                <span class="text-indigo-600" title="{{ __('Verified') }}">&#10003;</span>
            @endif
        </div>

        <details>
            <summary class="text-sm text-indigo-600 cursor-pointer">{{ __('Comments') }}</summary>
            <div class="mt-2 space-y-2 max-h-32 overflow-y-auto">
                @forelse ($reel->comments as $comment)
                    <p class="text-sm"><span class="font-medium">{{ $comment->user->name }}:</span> {{ $comment->body }}</p>
                @empty
                    <p class="text-sm text-gray-400">{{ __('No comments yet.') }}</p>
                @endforelse
            </div>
            <form method="POST" action="{{ route('reels.comments.store', $reel) }}" class="mt-2 flex gap-2">
                @csrf
                <input type="text" name="body" placeholder="{{ __('Add a comment...') }}" maxlength="1000"
                    class="flex-1 text-sm rounded-md border-gray-300">
                <button type="submit" class="text-sm text-indigo-600 font-medium">{{ __('Post') }}</button>
            </form>
        </details>
    </div>
</div>
