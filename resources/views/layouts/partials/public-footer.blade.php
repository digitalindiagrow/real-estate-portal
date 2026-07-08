<footer class="bg-midnight-950 text-gray-400 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-2 md:grid-cols-5 gap-8">
        <div class="col-span-2">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 011-1h0a1 1 0 011 1v4a1 1 0 001 1h4a1 1 0 001-1V10" />
                    </svg>
                </span>
                <span class="text-white font-extrabold text-sm">{{ strtoupper(config('app.name', 'Real Estate Portal')) }}</span>
            </div>
            <p class="text-sm mb-4">{{ __('India\'s smart property network connecting Buyers, tenants, Investors and property owners on one platform.') }}</p>
            <div class="flex gap-3">
                @foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $icon)
                    <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs uppercase">{{ substr($icon, 0, 1) }}</span>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">{{ __('Quick Links') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">{{ __('Home') }}</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'sale']) }}" class="hover:text-white">{{ __('Buy') }}</a></li>
                <li><a href="{{ route('properties.index', ['type' => 'rent']) }}" class="hover:text-white">{{ __('Rent') }}</a></li>
                <li><a href="{{ route('home') }}#investment-projects" class="hover:text-white">{{ __('Invest') }}</a></li>
                <li><a href="{{ route('reels.index') }}" class="hover:text-white">{{ __('Reels') }}</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">{{ __('Contact Us') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">{{ __('Property Categories') }}</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('Flats') }}</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('Houses') }}</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('Plots') }}</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('Villas') }}</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('Commercial') }}</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">{{ __('PG / Co-living') }}</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3 text-sm">{{ __('Contact Us') }}</h4>
            <ul class="space-y-2 text-sm">
                <li>+91 12345 67890</li>
                <li>hello@{{ Str::slug(config('app.name', 'realestate')) }}.com</li>
                <li>{{ __('Scheme No 78, Vijay Nagar, Indore, Madhya Pradesh 452010') }}</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs">
            <span>&copy; {{ date('Y') }} {{ config('app.name', 'Real Estate Portal') }}. {{ __('All rights reserved.') }}</span>
            <div class="flex gap-4">
                <a href="{{ route('contact') }}" class="hover:text-white">{{ __('Privacy Policy') }}</a>
                <a href="{{ route('contact') }}" class="hover:text-white">{{ __('Terms of Service') }}</a>
                <a href="{{ route('contact') }}" class="hover:text-white">{{ __('Sitemap') }}</a>
            </div>
        </div>
    </div>
</footer>
