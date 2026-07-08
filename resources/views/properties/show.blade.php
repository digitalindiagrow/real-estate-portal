@php
    $amenities = [
        ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'label' => 'Lift'],
        ['icon' => 'M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Parking'],
        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'label' => 'Power Backup'],
        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => '24x7 Security'],
        ['icon' => 'M4.5 12.75l6 6 9-13.5', 'label' => 'Gym'],
        ['icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Clubhouse'],
        ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Balcony'],
        ['icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m16 0h-4M9 7h6M9 11h6M9 15h6', 'label' => 'Modular Kitchen'],
        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Intercom'],
        ['icon' => 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z', 'label' => 'Fire Safety'],
        ['icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', 'label' => 'CCTV'],
        ['icon' => 'M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364l-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728l1.414 1.414M16.95 16.95l1.414 1.414', 'label' => 'Rain Water Harvesting'],
    ];

    $highlights = [
        'Well ventilated rooms with ample natural light',
        'Modern kitchen with modular fittings',
        '24x7 water supply and power backup',
        'Gated society with CCTV surveillance',
        'High-speed elevators and dedicated parking',
        'Close to schools, hospitals and daily conveniences',
    ];

    $whatsapp = $property->user->phone ? preg_replace('/\D/', '', $property->user->phone) : null;
@endphp

<x-public-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 pb-24 lg:pb-6">
        {{-- Breadcrumb --}}
        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
            <nav class="text-sm text-gray-500 flex items-center flex-wrap gap-1">
                <a href="{{ route('home') }}" class="hover:text-brand-600">{{ __('Home') }}</a>
                <span>&rsaquo;</span>
                <a href="{{ route('properties.index', ['type' => $property->type]) }}" class="hover:text-brand-600">{{ $property->type === 'rent' ? __('Rent') : __('Buy') }}</a>
                <span>&rsaquo;</span>
                <a href="{{ route('properties.index', ['type' => $property->type, 'city' => $property->city]) }}" class="hover:text-brand-600">{{ $property->city }}</a>
                <span>&rsaquo;</span>
                <span class="text-gray-700">{{ $property->area }}</span>
                <span>&rsaquo;</span>
                <span class="text-gray-700">{{ $property->title }}</span>
            </nav>
            <div class="flex items-center gap-3 text-sm text-gray-500">
                <button type="button" class="flex items-center gap-1 hover:text-red-500">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    {{ __('Save') }}
                </button>
                <button type="button" class="flex items-center gap-1 hover:text-brand-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342a3 3 0 100-2.684m0 2.684a3 3 0 100 2.684m0-2.684l6.632 3.316m0-6l-6.632 3.316m6.632-3.316a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 6a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" /></svg>
                    {{ __('Share') }}
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @include('properties.partials.gallery')

                <div class="mt-5">
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 rounded-full px-2.5 py-1 mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ __('Verified Owner') }}
                    </span>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $property->title }}</h1>
                    <p class="text-gray-500 flex items-center gap-1 mt-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        {{ $property->area }}, {{ $property->city }}
                    </p>

                    <div class="flex flex-wrap gap-2 mt-3">
                        <span class="text-xs font-medium text-gray-600 bg-gray-100 rounded-full px-3 py-1">{{ __(str_replace('_', ' ', ucfirst($property->category))) }}</span>
                        @if ($property->furnishing)
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 rounded-full px-3 py-1">{{ __(str_replace('_', ' ', ucfirst($property->furnishing))) }}</span>
                        @endif
                        @if ($property->type === 'rent' && $property->preferred_for)
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 rounded-full px-3 py-1">{{ __('Preferred: :for', ['for' => str_replace('_', ' ', ucfirst($property->preferred_for))]) }}</span>
                        @endif
                        @if ($property->type === 'sale' && $property->possession_status)
                            <span class="text-xs font-medium text-gray-600 bg-gray-100 rounded-full px-3 py-1">{{ __(str_replace('_', ' ', ucfirst($property->possession_status))) }}</span>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-5 bg-gray-50 rounded-xl p-4">
                        <div>
                            <p class="text-lg font-bold text-gray-800">&#8377;{{ number_format($property->price) }}{{ $property->type === 'rent' ? '/mo' : '' }}</p>
                            <p class="text-xs text-gray-400">{{ $property->type === 'rent' ? __('Rent') : __('Price') }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-800">{{ $property->bedrooms ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ __('Bedrooms') }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-800">{{ $property->bathrooms ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ __('Bathrooms') }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-gray-800">{{ $property->size_sqft ?? '-' }}</p>
                            <p class="text-xs text-gray-400">{{ __('Built-up Sq.Ft.') }}</p>
                        </div>
                    </div>

                    <div class="hidden lg:flex gap-3 mt-5">
                        <a href="#enquiry-form" class="flex-1 text-center border border-brand-600 text-brand-600 text-sm font-semibold py-2.5 rounded-lg hover:bg-brand-50">
                            {{ __('Schedule Visit') }}
                        </a>
                        @if ($property->user->phone)
                            <a href="tel:{{ $property->user->phone }}" class="flex-1 text-center bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg">
                                {{ __('Contact Owner') }}
                            </a>
                        @endif
                        @if ($whatsapp)
                            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="flex-1 text-center border border-emerald-500 text-emerald-600 text-sm font-semibold py-2.5 rounded-lg hover:bg-emerald-50">
                                {{ __('Chat on WhatsApp') }}
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Overview --}}
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5 mt-6">
                    <h2 class="font-semibold text-gray-800 mb-2">{{ __('Overview') }}</h2>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $property->description }}</p>
                </div>

                {{-- Property Highlights --}}
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5 mt-6">
                    <h2 class="font-semibold text-gray-800 mb-3">{{ __('Property Highlights') }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach ($highlights as $highlight)
                            <div class="flex items-start gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-emerald-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ __($highlight) }}
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Amenities --}}
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5 mt-6">
                    <h2 class="font-semibold text-gray-800 mb-3">{{ __('Amenities') }}</h2>
                    <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-4 text-center">
                        @foreach ($amenities as $amenity)
                            <div>
                                <div class="w-10 h-10 mx-auto rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center mb-1.5">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $amenity['icon'] }}" /></svg>
                                </div>
                                <p class="text-[11px] text-gray-500">{{ __($amenity['label']) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Location Advantage --}}
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5 mt-6">
                    <h2 class="font-semibold text-gray-800 mb-3">{{ __('Location Advantage') }}</h2>
                    <iframe src="{{ $mapEmbedUrl }}" class="w-full h-72 rounded-lg border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p class="text-sm text-gray-500 mt-3">{{ $property->address ? $property->address.', ' : '' }}{{ $property->area }}, {{ $property->city }}</p>
                </div>

                {{-- Property Video --}}
                @if ($reel)
                    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5 mt-6">
                        <h2 class="font-semibold text-gray-800 mb-3">{{ __('Property Video') }}</h2>
                        <video controls preload="metadata" class="w-full rounded-lg max-h-96"
                            @if ($reel->thumbnail_path) poster="{{ Storage::url($reel->thumbnail_path) }}" @endif>
                            <source src="{{ Storage::url($reel->video_path) }}">
                        </video>
                    </div>
                @endif

                {{-- Similar Properties --}}
                @if ($similar->isNotEmpty())
                    <div class="mt-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-gray-800">{{ $property->type === 'rent' ? __('Similar Rentals') : __('Similar Properties') }}</h2>
                            <a href="{{ route('properties.index', ['type' => $property->type, 'city' => $property->city]) }}" class="text-sm font-semibold text-brand-600 hover:underline">{{ __('View All') }}</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            @foreach ($similar as $similarProperty)
                                @include('properties.partials.featured-card', ['property' => $similarProperty])
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-5">
                    <h3 class="font-semibold text-gray-800 mb-1">{{ __('Connect with Owner') }}</h3>
                    @if ($property->user->is_verified)
                        <p class="text-xs text-emerald-600 mb-3">{{ __('Verified Owner') }}</p>
                    @endif
                    <div class="flex items-center gap-3 mb-4">
                        <img src="https://picsum.photos/seed/user-{{ $property->user->id }}/100/100" class="w-12 h-12 rounded-full object-cover" alt="{{ $property->user->name }}">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $property->user->name }}</p>
                            <p class="text-xs text-gray-400">{{ __('Property Owner') }}</p>
                        </div>
                    </div>
                    @if ($property->user->phone)
                        <a href="tel:{{ $property->user->phone }}" class="flex items-center justify-center gap-2 w-full bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg mb-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $property->user->phone }}
                        </a>
                    @endif
                    @if ($whatsapp)
                        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="flex items-center justify-center gap-2 w-full border border-emerald-500 text-emerald-600 text-sm font-semibold py-2.5 rounded-lg">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.94 11.94 0 0012.04 0C5.5 0 .2 5.3.2 11.84c0 2.09.55 4.13 1.6 5.93L0 24l6.4-1.68a11.86 11.86 0 005.64 1.44h.01c6.54 0 11.85-5.3 11.85-11.84 0-3.16-1.23-6.13-3.38-8.44zM12.05 21.3a9.4 9.4 0 01-4.8-1.31l-.34-.2-3.57.94.95-3.48-.22-.36a9.45 9.45 0 1117.94-4.05c0 5.22-4.25 9.46-9.96 9.46z" /></svg>
                            {{ __('Chat on WhatsApp') }}
                        </a>
                    @endif
                </div>

                @include('properties.partials.enquiry-form')

                @if ($property->type === 'sale')
                    @include('properties.partials.loan-calculator')
                @endif
            </div>
        </div>
    </div>

    @include('properties.partials.sticky-contact-bar')
</x-public-layout>
