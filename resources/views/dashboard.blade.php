<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">{{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}</p>
                    <div class="flex gap-3">
                        <a href="{{ route('my-properties.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-700">
                            {{ __('My Properties') }}
                        </a>
                        <a href="{{ route('my-properties.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-500">
                            {{ __('+ Add Property') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
