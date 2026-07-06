<x-public-layout>
    <div class="bg-gray-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold mb-2">{{ __('Find your next home') }}</h1>
            <p class="text-gray-300 mb-6">{{ __('Search properties for sale or rent by city and area.') }}</p>

            <form method="GET" action="{{ route('properties.index') }}" class="bg-white rounded-lg shadow p-4 flex flex-wrap gap-3">
                <input list="city-list" name="city" placeholder="{{ __('City (e.g. Mumbai)') }}"
                    class="flex-1 min-w-[150px] rounded-md border-gray-300 text-gray-900">
                <datalist id="city-list">
                    @foreach ($cities as $city)
                        <option value="{{ $city }}"></option>
                    @endforeach
                </datalist>

                <input type="text" name="area" placeholder="{{ __('Area (e.g. Andheri)') }}"
                    class="flex-1 min-w-[150px] rounded-md border-gray-300 text-gray-900">

                <select name="type" class="rounded-md border-gray-300 text-gray-900">
                    <option value="">{{ __('Any type') }}</option>
                    <option value="sale">{{ __('Sale') }}</option>
                    <option value="rent">{{ __('Rent') }}</option>
                </select>

                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-500">
                    {{ __('Search') }}
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Featured Properties') }}</h2>
        @if ($featured->isEmpty())
            <p class="text-gray-500 mb-10">{{ __('No featured properties yet.') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach ($featured as $property)
                    @include('properties.partials.card', ['property' => $property])
                @endforeach
            </div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Latest Properties') }}</h2>
        @if ($latest->isEmpty())
            <p class="text-gray-500">{{ __('No properties yet.') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($latest as $property)
                    @include('properties.partials.card', ['property' => $property])
                @endforeach
            </div>
        @endif
    </div>
</x-public-layout>
