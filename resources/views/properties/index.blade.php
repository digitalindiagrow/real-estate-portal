<x-public-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Browse Properties') }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-lg shadow p-4 flex flex-wrap gap-3 mb-8">
            <input list="city-list" name="city" value="{{ request('city') }}" placeholder="{{ __('City') }}"
                class="flex-1 min-w-[140px] rounded-md border-gray-300">
            <datalist id="city-list">
                @foreach ($cities as $city)
                    <option value="{{ $city }}"></option>
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
    </div>
</x-public-layout>
