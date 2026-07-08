@php
    $categories = [
        'apartment' => 'Apartment',
        'villa' => 'Villa',
        'independent_house' => 'Independent House',
        'plot' => 'Plot',
        'penthouse' => 'Penthouse',
        'studio_apartment' => 'Studio Apartment',
    ];
@endphp

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
            <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('Property Type') }}</h4>
            <div class="flex flex-wrap gap-2">
                <label>
                    <input type="radio" name="category" value="" class="peer sr-only" @checked(!request('category'))>
                    <span class="block text-xs px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 cursor-pointer peer-checked:bg-brand-600 peer-checked:text-white peer-checked:border-brand-600">{{ __('All') }}</span>
                </label>
                @foreach ($categories as $value => $label)
                    <label>
                        <input type="radio" name="category" value="{{ $value }}" class="peer sr-only" @checked(request('category') === $value)>
                        <span class="block text-xs px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 cursor-pointer peer-checked:bg-brand-600 peer-checked:text-white peer-checked:border-brand-600">{{ __($label) }}</span>
                    </label>
                @endforeach
            </div>
        </div>

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

        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('Furnishing') }}</h4>
            <div class="space-y-1.5">
                @foreach (['furnished' => 'Furnished', 'semi_furnished' => 'Semi Furnished', 'unfurnished' => 'Unfurnished'] as $value => $label)
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="radio" name="furnishing" value="{{ $value }}" class="text-brand-600 focus:ring-brand-500" @checked(request('furnishing') === $value)>
                        {{ __($label) }}
                    </label>
                @endforeach
            </div>
        </div>

        @if ($type === 'rent')
            <div>
                <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('Preferred For') }}</h4>
                <div class="space-y-1.5">
                    @foreach (['family' => 'Family', 'bachelor' => 'Bachelor', 'company_lease' => 'Company Lease'] as $value => $label)
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="radio" name="preferred_for" value="{{ $value }}" class="text-brand-600 focus:ring-brand-500" @checked(request('preferred_for') === $value)>
                            {{ __($label) }}
                        </label>
                    @endforeach
                </div>
            </div>
        @else
            <div>
                <h4 class="text-sm font-semibold text-gray-700 mb-2">{{ __('Possession Status') }}</h4>
                <div class="space-y-1.5">
                    @foreach (['ready_to_move' => 'Ready to Move', 'under_construction' => 'Under Construction'] as $value => $label)
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="radio" name="possession_status" value="{{ $value }}" class="text-brand-600 focus:ring-brand-500" @checked(request('possession_status') === $value)>
                            {{ __($label) }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg">
            {{ __('Apply Filters') }}
        </button>
    </form>
</div>
