@if ($topLocalities && $topLocalities->isNotEmpty())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">
                {{ str_replace(':city', $cities->first() ?? 'Your City', $localities_heading) }}
            </h2>
            <a href="{{ route('properties.index', ['type' => $type]) }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All') }}</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($topLocalities as $locality)
                <a href="{{ route('properties.index', ['type' => $type, 'city' => $locality->city, 'area' => $locality->area]) }}"
                    class="bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition p-4 text-center">
                    <div class="w-10 h-10 mx-auto rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7M9 9v.01M9 12v.01M9 15v.01" /></svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800">{{ $locality->area }}</p>
                    <p class="text-xs text-gray-400">{{ $locality->properties_count }}+ {{ __('Properties') }}</p>
                    <p class="text-xs text-gray-400">&#8377;{{ number_format($locality->min_price) }} &ndash; &#8377;{{ number_format($locality->max_price) }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endif
