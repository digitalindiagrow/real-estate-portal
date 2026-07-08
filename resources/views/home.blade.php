<x-public-layout>

    {{-- Hero --}}
    <section class="relative bg-midnight-950 overflow-hidden">
        <img src="https://picsum.photos/seed/hero-villa/1600/900" alt="" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="absolute inset-0 bg-gradient-to-r from-midnight-950 via-midnight-950/90 to-midnight-950/40"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-20">
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-emerald-300 bg-emerald-500/10 border border-emerald-500/30 rounded-full px-3 py-1 mb-5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ __('Verified Properties Only') }}
            </span>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-white leading-tight max-w-2xl">
                {{ __("India's") }} <span class="bg-gradient-to-r from-brand-400 to-brand-200 bg-clip-text text-transparent">{{ __('Smart') }}</span> {{ __('Property Network') }}
            </h1>
            <p class="text-lg text-gray-300 mt-3">{{ __('Buy · Rent · Invest · Earn') }}</p>
            <p class="text-gray-400 max-w-lg mt-3">
                {{ __('Find verified properties. Connect directly with builders & owners. Buy, rent, invest and earn more with India\'s most trusted network.') }}
            </p>

            <div class="mt-8 max-w-3xl">
                <div class="inline-flex bg-midnight-800/80 rounded-t-lg overflow-hidden">
                    <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="px-5 py-2.5 text-sm font-semibold bg-brand-600 text-white">{{ __('Buy') }}</a>
                    <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white">{{ __('Rent') }}</a>
                    <a href="{{ route('home') }}#investment-projects" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white">{{ __('Invest') }}</a>
                </div>

                <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-b-lg rounded-tr-lg shadow-xl p-4 flex flex-wrap gap-3 items-center">
                    <div class="flex-1 min-w-[160px]">
                        <label class="block text-[11px] text-gray-400 mb-1">{{ __('Location') }}</label>
                        <input list="city-list" name="city" placeholder="{{ __('Indore, MP') }}" class="w-full border-0 focus:ring-0 p-0 text-sm text-gray-800 placeholder-gray-400">
                        <datalist id="city-list">
                            @foreach ($cities as $city)
                                <option value="{{ $city }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="w-px h-10 bg-gray-200 hidden sm:block"></div>
                    <div class="flex-1 min-w-[140px]">
                        <label class="block text-[11px] text-gray-400 mb-1">{{ __('Property Type') }}</label>
                        <select name="type" class="w-full border-0 focus:ring-0 p-0 text-sm text-gray-800">
                            <option value="">{{ __('All Type') }}</option>
                            <option value="sale">{{ __('Sale') }}</option>
                            <option value="rent">{{ __('Rent') }}</option>
                        </select>
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
                        {{ __('Search') }}
                    </button>
                </form>

                <div class="flex flex-wrap items-center gap-2 mt-4 text-xs">
                    <span class="text-gray-400">{{ __('Popular Searches:') }}</span>
                    @foreach ($cities->take(4) as $city)
                        <a href="{{ route('properties.index', ['city' => $city]) }}" class="text-gray-300 border border-white/20 rounded-full px-3 py-1 hover:bg-white/10">{{ $city }}</a>
                    @endforeach
                </div>
            </div>
        </div>

        @if ($featured->isNotEmpty())
            @php $spot = $featured->first(); @endphp
            <a href="{{ route('properties.show', $spot) }}" class="hidden xl:block absolute right-16 top-28 w-64 bg-white rounded-xl shadow-2xl overflow-hidden">
                <div class="relative h-36">
                    <img src="{{ !empty($spot->images) ? $spot->images[0] : 'https://picsum.photos/seed/spotlight-'.$spot->id.'/500/360' }}" class="w-full h-full object-cover" alt="">
                    <button type="button" class="absolute top-2 right-2 w-7 h-7 rounded-full bg-white/90 flex items-center justify-center text-gray-500">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    </button>
                </div>
                <div class="p-3">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-gray-800 text-sm">{{ $spot->title }}</p>
                        <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    </div>
                    <p class="text-xs text-gray-500">{{ $spot->area }}, {{ $spot->city }}</p>
                    <p class="text-brand-600 font-bold text-sm mt-1">&#8377;{{ number_format($spot->price) }}</p>
                    <span class="block text-center text-xs font-semibold text-brand-600 border border-brand-600 rounded-lg py-1.5 mt-2 hover:bg-brand-50">{{ __('View Details') }}</span>
                </div>
            </a>
        @endif
    </section>

    {{-- Icon feature row --}}
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-3 sm:grid-cols-6 gap-6 text-center">
            @foreach ([
                ['icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Verified Properties', 'sub' => '100% Verified'],
                ['icon' => 'M3 21h18M5 21V7l8-4v18M13 21V11l6 3v7M9 9v.01M9 12v.01M9 15v.01', 'title' => 'Builder Direct', 'sub' => 'No Brokerage'],
                ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'title' => 'AI Property Match', 'sub' => 'Smart Search'],
                ['icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', 'title' => 'Reels', 'sub' => 'Watch & Connect'],
                ['icon' => 'M9 19v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6m-6 0H5a2 2 0 01-2-2V7a2 2 0 012-2h2m10 14h2a2 2 0 002-2V7a2 2 0 00-2-2h-2', 'title' => 'Invest in Projects', 'sub' => 'High Returns'],
                ['icon' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2', 'title' => 'List Property', 'sub' => 'Post for Free'],
            ] as $feature)
                <div>
                    <div class="w-11 h-11 mx-auto rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" /></svg>
                    </div>
                    <p class="text-xs sm:text-sm font-semibold text-gray-800">{{ __($feature['title']) }}</p>
                    <p class="text-[11px] text-gray-400">{{ __($feature['sub']) }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Property Reels strip --}}
    @if ($reelsStrip->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" /></svg>
                    {{ __('Property Reels') }}
                </h2>
                <a href="{{ route('reels.index') }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All →') }}</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-2">
                @foreach ($reelsStrip as $reel)
                    @include('properties.partials.reel-strip-card', ['reel' => $reel])
                @endforeach
            </div>
        </section>
    @endif

    {{-- Featured Properties --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ __('Featured Properties') }}</h2>
            <a href="{{ route('properties.index', ['featured_only' => 1]) }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All →') }}</a>
        </div>
        @if ($featured->isEmpty())
            <p class="text-gray-500">{{ __('No featured properties yet.') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featured as $property)
                    @include('properties.partials.featured-card', ['property' => $property])
                @endforeach
            </div>
        @endif
    </section>

    {{-- Stats bar --}}
    <section class="bg-gradient-to-r from-brand-700 via-brand-600 to-brand-500 my-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 grid grid-cols-2 sm:grid-cols-4 gap-6 text-white text-center sm:text-left">
            @foreach ($stats as $stat)
                <div>
                    <p class="text-3xl font-extrabold">{{ $stat['value'] }}</p>
                    <p class="text-sm text-white/80">{{ __($stat['label']) }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Investment Projects --}}
    <section id="investment-projects" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ __('Investment Projects') }}</h2>
            <a href="{{ route('properties.index') }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All →') }}</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($investment_projects as $project)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                    <div class="relative h-40">
                        <img src="https://picsum.photos/seed/{{ $project['image_seed'] }}/600/400" class="w-full h-full object-cover" alt="">
                        <span class="absolute top-3 left-3 text-[11px] font-semibold bg-brand-600 text-white px-2.5 py-1 rounded-full">{{ __($project['badge']) }}</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800">{{ $project['title'] }}</h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $project['location'] }}</p>
                        <div class="flex justify-between text-xs text-gray-500 mb-3">
                            <div>
                                <p class="uppercase">{{ __('Expected Return') }}</p>
                                <p class="text-gray-800 font-semibold">{{ $project['expected_return'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="uppercase">{{ __('Min. Investment') }}</p>
                                <p class="text-gray-800 font-semibold">&#8377;{{ $project['min_investment'] }}</p>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="block text-center bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2 rounded-lg">{{ __('Invest Now') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Luxury banner --}}
    <section class="relative my-12 mx-4 sm:mx-6 lg:mx-8 rounded-2xl overflow-hidden">
        <img src="https://picsum.photos/seed/luxury-living/1600/500" class="w-full h-72 object-cover" alt="">
        <div class="absolute inset-0 bg-gradient-to-r from-midnight-950/90 via-midnight-950/60 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-center px-8 sm:px-14 max-w-xl">
            <p class="text-xs tracking-widest text-gray-300 mb-2">{{ __('LIVE THE LIFE YOU DESERVE') }}</p>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-1">{{ __('Luxury Living') }}</h2>
            <h2 class="text-3xl sm:text-4xl font-extrabold bg-gradient-to-r from-brand-400 to-brand-200 bg-clip-text text-transparent mb-4">{{ __('Starts Here') }}</h2>
            <p class="text-gray-300 mb-5">{{ __('Discover handpicked premium properties in the most prestigious locations. Your dream home is just a search away.') }}</p>
            <a href="{{ route('properties.index', ['featured_only' => 1]) }}" class="inline-block bg-white text-midnight-950 font-semibold text-sm px-6 py-3 rounded-lg w-fit">{{ __('Explore Premium Listings →') }}</a>
        </div>
    </section>

    {{-- Explore by City --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">{{ __('Explore by City') }}</h2>
        @if ($exploreCities->isEmpty())
            <p class="text-gray-500 text-sm">{{ __('No properties yet.') }}</p>
        @else
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-4">
                @foreach ($exploreCities as $cityCard)
                    <a href="{{ route('properties.index', ['city' => $cityCard->city]) }}" class="group block rounded-xl overflow-hidden relative h-28">
                        <img src="https://picsum.photos/seed/city-{{ \Illuminate\Support\Str::slug($cityCard->city) }}/300/300" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-2 left-2 right-2">
                            <p class="text-white text-sm font-semibold">{{ $cityCard->city }}</p>
                            <p class="text-gray-300 text-[11px]">{{ $cityCard->properties_count }}+ {{ __('Properties') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Why Choose Us / Top Builders / Testimonials --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div>
            <h2 class="text-lg font-bold text-gray-800 mb-4">{{ __('Why Choose') }} {{ config('app.name', 'Us') }}?</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($why_choose_us as $item)
                    <div>
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-800">{{ __($item['title']) }}</p>
                        <p class="text-xs text-gray-500">{{ __($item['description']) }}</p>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('contact') }}" class="inline-block mt-5 bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg">{{ __('Learn More About Us') }}</a>
        </div>

        <div id="top-builders">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">{{ __('Top Builders') }}</h2>
                <a href="{{ route('contact') }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All') }}</a>
            </div>
            <div class="grid grid-cols-3 gap-3">
                @foreach ($builders as $builder)
                    <div class="border border-gray-100 rounded-xl h-16 flex items-center justify-center text-center text-xs font-semibold text-gray-600 px-2">
                        {{ $builder['name'] }}
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">{{ __('Client Testimonials') }}</h2>
                <a href="{{ route('contact') }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All') }}</a>
            </div>
            @php $t = $testimonials[0]; @endphp
            <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5">
                <p class="text-2xl text-brand-300 leading-none mb-2">&ldquo;</p>
                <p class="text-sm text-gray-600 mb-4">{{ $t['quote'] }}</p>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">— {{ $t['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $t['location'] }}</p>
                    </div>
                    <div class="text-amber-400 text-sm">
                        {{ str_repeat('★', $t['rating']) }}{{ str_repeat('☆', 5 - $t['rating']) }}
                    </div>
                </div>
                <div class="flex gap-1.5 mt-4">
                    @foreach ($testimonials as $i => $item)
                        <span class="w-1.5 h-1.5 rounded-full {{ $i === 0 ? 'bg-brand-600' : 'bg-gray-200' }}"></span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA banner --}}
    <section class="bg-gradient-to-r from-midnight-950 to-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <h2 class="text-xl sm:text-2xl font-bold text-white text-center md:text-left">{{ __('Ready to Find or Post Your Property?') }}</h2>
            <p class="text-gray-300 text-sm hidden lg:block">{{ __('Join thousands of satisfied buyers, tenants and investors today.') }}</p>
            <div class="flex gap-3">
                <a href="{{ route('properties.index') }}" class="bg-white text-midnight-950 text-sm font-semibold px-5 py-2.5 rounded-lg">{{ __('Explore Properties') }}</a>
                <a href="{{ auth()->check() ? route('my-properties.create') : route('register') }}" class="bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg">{{ __('Post Your Property') }}</a>
            </div>
        </div>
    </section>

</x-public-layout>
