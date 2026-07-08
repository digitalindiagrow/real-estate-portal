<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Real Estate Portal') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50" x-data="{ moreOpen: false, mobileOpen: false }">
        <nav class="bg-midnight-950 border-b border-white/10 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                        <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 011-1h0a1 1 0 011 1v4a1 1 0 001 1h4a1 1 0 001-1V10" />
                            </svg>
                        </span>
                        <span class="leading-tight">
                            <span class="block text-white font-extrabold text-sm tracking-wide">{{ strtoupper(config('app.name', 'Real Estate Portal')) }}</span>
                            <span class="block text-[11px] text-gray-400">{{ __('Right Property, Right Choice') }}</span>
                        </span>
                    </a>

                    <div class="hidden lg:flex items-center gap-7 ms-8">
                        <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-white border-b-2 border-brand-500 pb-5 -mb-5' : 'text-gray-300 hover:text-white' }}">{{ __('Home') }}</a>
                        <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Buy') }}</a>
                        <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Rent') }}</a>
                        <a href="{{ route('home') }}#investment-projects" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Invest') }}</a>
                        <a href="{{ route('reels.index') }}" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Reels') }}</a>
                        <a href="{{ route('home') }}#top-builders" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Builders') }}</a>
                        <a href="{{ route('home') }}#top-builders" class="text-sm font-medium text-gray-300 hover:text-white">{{ __('Agents') }}</a>

                        <div class="relative" @click.outside="moreOpen = false">
                            <button @click="moreOpen = !moreOpen" type="button" class="text-sm font-medium text-gray-300 hover:text-white flex items-center gap-1">
                                {{ __('More') }}
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 20 20" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 8l4 4 4-4" /></svg>
                            </button>
                            <div x-show="moreOpen" x-cloak class="absolute mt-3 w-40 bg-white rounded-md shadow-lg py-1 text-sm">
                                <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('Contact') }}</a>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('Dashboard') }}</a>
                                    <a href="{{ route('my-properties.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('My Properties') }}</a>
                                    <a href="{{ route('my-reels.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('My Reels') }}</a>
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">{{ __('Admin Panel') }}</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="hidden lg:flex items-center gap-3">
                        <a href="{{ auth()->check() ? route('my-properties.create') : route('register') }}"
                            class="bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                            {{ __('Post Property') }}
                        </a>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-1.5 text-sm text-gray-300 hover:text-white border border-white/20 px-4 py-2.5 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 17l5-5-5-5M21 12H9m4 8H5a2 2 0 01-2-2V6a2 2 0 012-2h8" /></svg>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center gap-1.5 text-sm text-gray-300 hover:text-white border border-white/20 px-4 py-2.5 rounded-lg">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                {{ __('Login / Sign Up') }}
                            </a>
                        @endauth
                    </div>

                    <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden text-gray-300">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak class="lg:hidden bg-midnight-900 border-t border-white/10 px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-200">{{ __('Home') }}</a>
                <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="block text-gray-200">{{ __('Buy') }}</a>
                <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="block text-gray-200">{{ __('Rent') }}</a>
                <a href="{{ route('home') }}#investment-projects" class="block text-gray-200">{{ __('Invest') }}</a>
                <a href="{{ route('reels.index') }}" class="block text-gray-200">{{ __('Reels') }}</a>
                <a href="{{ route('contact') }}" class="block text-gray-200">{{ __('Contact') }}</a>
                <a href="{{ auth()->check() ? route('my-properties.create') : route('register') }}" class="block bg-brand-600 text-white text-center py-2.5 rounded-lg font-semibold">{{ __('Post Property') }}</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-gray-200">{{ __('Dashboard') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block text-gray-200">{{ __('Log Out') }}</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-gray-200">{{ __('Login / Sign Up') }}</a>
                @endauth
            </div>
        </nav>

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            @if (session('status'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>

        @include('layouts.partials.public-footer')
    </body>
</html>
