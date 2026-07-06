<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Real Estate Portal') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center space-x-8">
                            <a href="{{ route('home') }}" class="font-bold text-lg text-gray-800">
                                {{ config('app.name', 'Real Estate Portal') }}
                            </a>
                            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Home') }}</a>
                            <a href="{{ route('properties.index', ['type' => 'sale']) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Buy') }}</a>
                            <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Rent') }}</a>
                            <a href="{{ auth()->check() ? route('my-properties.create') : route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Sell') }}</a>
                            <a href="{{ route('reels.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Reels') }}</a>
                            <a href="{{ route('contact') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Contact') }}</a>
                        </div>

                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Dashboard') }}</a>
                                <a href="{{ route('my-properties.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('My Properties') }}</a>
                                <a href="{{ route('my-reels.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('My Reels') }}</a>
                                @if (Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Admin Panel') }}</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Log Out') }}</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Log in') }}</a>
                                <a href="{{ route('register') }}" class="text-sm font-medium text-white bg-gray-800 px-4 py-2 rounded-md hover:bg-gray-700">{{ __('Register') }}</a>
                            @endauth
                        </div>
                    </div>
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
        </div>
    </body>
</html>
