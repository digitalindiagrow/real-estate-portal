<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-800">{{ __('Filters') }}</h3>
        <a href="{{ route('properties.index', array_filter(['type' => $type])) }}" class="text-xs font-medium text-brand-600 hover:underline">{{ __('Reset') }}</a>
    </div>

    <form method="GET" action="{{ route('properties.index') }}" class="space-y-6">
        @if ($type)
            <input type="hidden" name="type" value="{{ $type }}">
        @endif

        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('Location') }}</h4>
            <input type="text" name="city" value="{{ request('city') }}" list="sidebar-city-list" placeholder="{{ __('Search location') }}"
                class="w-full text-sm rounded-md border-gray-300">
            <datalist id="sidebar-city-list">
                @foreach ($cities as $cityOption)
                    <option value="{{ $cityOption }}"></option>
                @endforeach
            </datalist>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ $type === 'rent' ? __('Budget (Monthly Rent)') : __('Budget') }}</h4>
            <div class="grid grid-cols-2 gap-2">
                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="{{ __('Min') }}" class="text-sm rounded-md border-gray-300">
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="{{ __('Max') }}" class="text-sm rounded-md border-gray-300">
            </div>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('BHK Type') }}</h4>
            <div class="space-y-1.5">
                @foreach ([1 => '1 BHK', 2 => '2 BHK', 3 => '3 BHK', 4 => '4+ BHK'] as $value => $label)
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="radio" name="bedrooms" value="{{ $value }}" class="text-brand-600 focus:ring-brand-500" @checked(request('bedrooms') == $value)>
                        {{ __($label) }}
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg">
            {{ __('Apply Filters') }}
        </button>
    </form>
</div>
