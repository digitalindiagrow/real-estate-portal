<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Admin') }} - {{ config('app.name', 'Real Estate Portal') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-100">
            <aside class="w-64 bg-gray-900 text-gray-200 flex-shrink-0">
                <div class="px-6 py-5 text-lg font-bold text-white border-b border-gray-800">
                    {{ __('Admin Panel') }}
                </div>
                <nav class="mt-4 space-y-1 px-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2 rounded-md text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="block px-4 py-2 rounded-md text-sm {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                        {{ __('Manage Users') }}
                    </a>
                    <a href="{{ route('admin.properties.index') }}"
                        class="block px-4 py-2 rounded-md text-sm {{ request()->routeIs('admin.properties.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                        {{ __('Manage Properties') }}
                    </a>
                    <a href="{{ route('admin.reels.index') }}"
                        class="block px-4 py-2 rounded-md text-sm {{ request()->routeIs('admin.reels.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800' }}">
                        {{ __('Manage Reels') }}
                    </a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded-md text-sm hover:bg-gray-800">
                        {{ __('View Site') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded-md text-sm hover:bg-gray-800">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </nav>
            </aside>

            <div class="flex-1">
                @isset($header)
                    <header class="bg-white shadow px-6 py-4">
                        <h2 class="font-semibold text-xl text-gray-800">{{ $header }}</h2>
                    </header>
                @endisset

                <main class="p-6">
                    @if (session('status'))
                        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
