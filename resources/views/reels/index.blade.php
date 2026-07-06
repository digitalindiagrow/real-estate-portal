<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Property Reels') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="GET" action="{{ route('reels.index') }}" class="bg-white rounded-lg shadow p-4 flex flex-wrap gap-3 mb-8">
            <input list="city-list" name="city" value="{{ request('city') }}" placeholder="{{ __('City') }}"
                class="flex-1 min-w-[140px] rounded-md border-gray-300">
            <datalist id="city-list">
                @foreach ($cities as $city)
                    <option value="{{ $city }}"></option>
                @endforeach
            </datalist>

            <select name="type" class="rounded-md border-gray-300">
                <option value="">{{ __('Any type') }}</option>
                <option value="sale" @selected(request('type') === 'sale')>{{ __('Sale') }}</option>
                <option value="rent" @selected(request('type') === 'rent')>{{ __('Rent') }}</option>
            </select>

            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="{{ __('Min price') }}"
                class="w-32 rounded-md border-gray-300">
            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="{{ __('Max price') }}"
                class="w-32 rounded-md border-gray-300">

            <select name="sort" class="rounded-md border-gray-300">
                <option value="newest" @selected(request('sort', 'newest') === 'newest')>{{ __('Newest') }}</option>
                <option value="popular" @selected(request('sort') === 'popular')>{{ __('Popular') }}</option>
            </select>

            <input type="hidden" name="view" value="{{ $view }}">

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('reels.index') }}" class="text-sm text-gray-500 self-center hover:underline">{{ __('Reset') }}</a>

            <div class="ms-auto flex gap-2 self-center">
                <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"
                    class="px-3 py-1.5 rounded-md text-sm {{ $view === 'grid' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600' }}">{{ __('Grid') }}</a>
                <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"
                    class="px-3 py-1.5 rounded-md text-sm {{ $view === 'list' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600' }}">{{ __('List') }}</a>
            </div>
        </form>

        @if ($reels->isEmpty())
            <p class="text-gray-500">{{ __('No reels match your search yet.') }}</p>
        @else
            <div class="grid grid-cols-1 {{ $view === 'grid' ? 'sm:grid-cols-2 lg:grid-cols-3' : '' }} gap-6 mb-8">
                @foreach ($reels as $reel)
                    @include('reels.partials.card', ['reel' => $reel])
                @endforeach
            </div>

            {{ $reels->links() }}
        @endif
    </div>
</x-public-layout>
