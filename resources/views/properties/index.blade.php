<x-public-layout>
    @if ($type)
        {{-- Type-specific hero --}}
        <section class="relative bg-midnight-950 overflow-hidden">
            <img src="https://picsum.photos/seed/{{ $hero_image_seed }}/1600/500" alt="" class="absolute inset-0 w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-midnight-950 via-midnight-950/90 to-midnight-950/50"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-white max-w-lg">
                    {!! preg_replace('/(Dream Property|Rental Home)/', '<span class="bg-gradient-to-r from-brand-400 to-brand-200 bg-clip-text text-transparent">$1</span>', e($hero_title)) !!}
                </h1>
                <p class="text-gray-300 mt-2 max-w-lg">{{ $hero_subtitle }}</p>

                <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-lg shadow-xl p-4 mt-6 flex flex-wrap gap-3 items-center max-w-3xl">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="flex-1 min-w-[160px]">
                        <label class="block text-[11px] text-gray-400 mb-1">{{ __('Location') }}</label>
                        <input list="hero-city-list" name="city" value="{{ request('city') }}" placeholder="{{ __('Indore, MP') }}" class="w-full border-0 focus:ring-0 p-0 text-sm text-gray-800 placeholder-gray-400">
                        <datalist id="hero-city-list">
                            @foreach ($cities as $cityOption)
                                <option value="{{ $cityOption }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="w-px h-10 bg-gray-200 hidden sm:block"></div>
                    <div class="flex-1 min-w-[140px]">
                        <label class="block text-[11px] text-gray-400 mb-1">{{ __('Budget') }}</label>
                        <select name="max_price" class="w-full border-0 focus:ring-0 p-0 text-sm text-gray-800">
                            <option value="">{{ __('Any Budget') }}</option>
                            <option value="2000000">{{ __('Under ₹20L') }}</option>
                            <option value="5000000">{{ __('Under ₹50L') }}</option>
                            <option value="10000000">{{ __('Under ₹1Cr') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold px-6 py-3 rounded-lg">
                        {{ $search_label }}
                    </button>
                </form>
            </div>

            <div class="relative bg-midnight-900 border-t border-white/10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach ($trust_strip as $item)
                        <div class="flex items-center gap-2">
                            <span class="w-9 h-9 rounded-lg bg-white/10 text-brand-300 flex items-center justify-center shrink-0">
                                <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" /></svg>
                            </span>
                            <div>
                                <p class="text-xs font-semibold text-white">{{ __($item['title']) }}</p>
                                <p class="text-[11px] text-gray-400">{{ __($item['sub']) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Browse Properties') }}</h2>
        </x-slot>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($type)
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                <div class="lg:col-span-1">
                    @include('properties.partials.sidebar-filters')
                </div>

                <div class="lg:col-span-4">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-gray-500">{{ __('Showing :count Properties', ['count' => number_format($properties->total())]) }}</p>
                        <form method="GET" class="flex items-center gap-2">
                            <input type="hidden" name="type" value="{{ $type }}">
                            @foreach (request()->except(['sort', 'type']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <label class="text-xs text-gray-500">{{ __('Sort By:') }}</label>
                            <select name="sort" onchange="this.form.submit()" class="text-sm rounded-md border-gray-300">
                                <option value="" @selected(!request('sort'))>{{ __('Newest First') }}</option>
                                <option value="price_low" @selected(request('sort') === 'price_low')>{{ __('Price: Low to High') }}</option>
                                <option value="price_high" @selected(request('sort') === 'price_high')>{{ __('Price: High to Low') }}</option>
                            </select>
                        </form>
                    </div>

                    @if ($properties->isEmpty())
                        <p class="text-gray-500">{{ __('No properties match your search.') }}</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
                            @foreach ($properties as $property)
                                @include('properties.partials.featured-card', ['property' => $property])
                            @endforeach
                        </div>
                        {{ $properties->links() }}
                    @endif
                </div>
            </div>
        @else
            <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-lg shadow p-4 flex flex-wrap gap-3 mb-8">
                <input list="city-list" name="city" value="{{ request('city') }}" placeholder="{{ __('City') }}"
                    class="flex-1 min-w-[140px] rounded-md border-gray-300">
                <datalist id="city-list">
                    @foreach ($cities as $cityOption)
                        <option value="{{ $cityOption }}"></option>
                    @endforeach
                </datalist>

                <input type="text" name="area" value="{{ request('area') }}" placeholder="{{ __('Area') }}"
                    class="flex-1 min-w-[140px] rounded-md border-gray-300">

                <select name="type" class="rounded-md border-gray-300">
                    <option value="">{{ __('Any type') }}</option>
                    <option value="sale" @selected(request('type') === 'sale')>{{ __('Sale') }}</option>
                    <option value="rent" @selected(request('type') === 'rent')>{{ __('Rent') }}</option>
                </select>

                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="{{ __('Min price') }}"
                    class="w-32 rounded-md border-gray-300">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="{{ __('Max price') }}"
                    class="w-32 rounded-md border-gray-300">

                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                    {{ __('Filter') }}
                </button>
                <a href="{{ route('properties.index') }}" class="text-sm text-gray-500 self-center hover:underline">{{ __('Reset') }}</a>
            </form>

            @if ($properties->isEmpty())
                <p class="text-gray-500">{{ __('No properties match your search.') }}</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($properties as $property)
                        @include('properties.partials.card', ['property' => $property])
                    @endforeach
                </div>
                {{ $properties->links() }}
            @endif
        @endif
    </div>

    @if ($type)
        {{-- CTA banner --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-10">
            <div class="bg-gradient-to-r from-midnight-950 to-brand-800 rounded-2xl overflow-hidden relative">
                <img src="https://picsum.photos/seed/{{ $hero_image_seed }}-cta/1200/400" class="absolute inset-0 w-full h-full object-cover opacity-20" alt="">
                <div class="relative p-6 sm:p-8 flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $cta_banner['title'] }}</h3>
                        <p class="text-gray-300 text-sm mt-1">{{ $cta_banner['subtitle'] }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach ($cta_banner['stats'] as $stat)
                                <span class="text-xs text-white bg-white/10 rounded-full px-3 py-1">✓ {{ $stat['value'] }} {{ __($stat['label']) }}</span>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="bg-white text-midnight-950 text-sm font-semibold px-6 py-3 rounded-lg shrink-0">
                        {{ $cta_banner['button_label'] }}
                    </a>
                </div>
            </div>
        </section>

        @include('properties.partials.top-localities')

        {{-- Why us row --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $why_us_heading }}</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($why_us as $item)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 text-center">
                        <div class="w-9 h-9 mx-auto rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-800">{{ __($item['title']) }}</p>
                        <p class="text-xs text-gray-400">{{ __($item['sub']) }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</x-public-layout>
