@php $p = $property ?? null; @endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div class="sm:col-span-2">
        <x-input-label for="title" :value="__('Title')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', $p?->title) }}" required />
        <x-input-error :messages="$errors->get('title')" class="mt-1" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300" required>{{ old('description', $p?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="type" :value="__('Type')" />
        <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300" required>
            <option value="sale" @selected(old('type', $p?->type) === 'sale')>{{ __('Sale') }}</option>
            <option value="rent" @selected(old('type', $p?->type) === 'rent')>{{ __('Rent') }}</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="category" :value="__('Property Type')" />
        <select id="category" name="category" class="mt-1 block w-full rounded-md border-gray-300" required>
            @foreach (['apartment' => 'Apartment', 'villa' => 'Villa', 'independent_house' => 'Independent House', 'plot' => 'Plot', 'penthouse' => 'Penthouse', 'studio_apartment' => 'Studio Apartment'] as $value => $label)
                <option value="{{ $value }}" @selected(old('category', $p?->category) === $value)>{{ __($label) }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" value="{{ old('price', $p?->price) }}" required />
        <x-input-error :messages="$errors->get('price')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="city" :value="__('City')" />
        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" value="{{ old('city', $p?->city) }}" required />
        <x-input-error :messages="$errors->get('city')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="area" :value="__('Area')" />
        <x-text-input id="area" name="area" type="text" class="mt-1 block w-full" value="{{ old('area', $p?->area) }}" required />
        <x-input-error :messages="$errors->get('area')" class="mt-1" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="address" :value="__('Address (optional)')" />
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address', $p?->address) }}" />
        <x-input-error :messages="$errors->get('address')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="bedrooms" :value="__('Bedrooms')" />
        <x-text-input id="bedrooms" name="bedrooms" type="number" class="mt-1 block w-full" value="{{ old('bedrooms', $p?->bedrooms) }}" />
        <x-input-error :messages="$errors->get('bedrooms')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="bathrooms" :value="__('Bathrooms')" />
        <x-text-input id="bathrooms" name="bathrooms" type="number" class="mt-1 block w-full" value="{{ old('bathrooms', $p?->bathrooms) }}" />
        <x-input-error :messages="$errors->get('bathrooms')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="size_sqft" :value="__('Size (sqft)')" />
        <x-text-input id="size_sqft" name="size_sqft" type="number" class="mt-1 block w-full" value="{{ old('size_sqft', $p?->size_sqft) }}" />
        <x-input-error :messages="$errors->get('size_sqft')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="furnishing" :value="__('Furnishing')" />
        <select id="furnishing" name="furnishing" class="mt-1 block w-full rounded-md border-gray-300">
            <option value="">{{ __('Not specified') }}</option>
            <option value="furnished" @selected(old('furnishing', $p?->furnishing) === 'furnished')>{{ __('Furnished') }}</option>
            <option value="semi_furnished" @selected(old('furnishing', $p?->furnishing) === 'semi_furnished')>{{ __('Semi Furnished') }}</option>
            <option value="unfurnished" @selected(old('furnishing', $p?->furnishing) === 'unfurnished')>{{ __('Unfurnished') }}</option>
        </select>
        <x-input-error :messages="$errors->get('furnishing')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="preferred_for" :value="__('Preferred For (rentals)')" />
        <select id="preferred_for" name="preferred_for" class="mt-1 block w-full rounded-md border-gray-300">
            <option value="">{{ __('Not specified') }}</option>
            <option value="family" @selected(old('preferred_for', $p?->preferred_for) === 'family')>{{ __('Family') }}</option>
            <option value="bachelor" @selected(old('preferred_for', $p?->preferred_for) === 'bachelor')>{{ __('Bachelor') }}</option>
            <option value="company_lease" @selected(old('preferred_for', $p?->preferred_for) === 'company_lease')>{{ __('Company Lease') }}</option>
        </select>
        <x-input-error :messages="$errors->get('preferred_for')" class="mt-1" />
    </div>

    <div>
        <x-input-label for="possession_status" :value="__('Possession Status (sale)')" />
        <select id="possession_status" name="possession_status" class="mt-1 block w-full rounded-md border-gray-300">
            <option value="">{{ __('Not specified') }}</option>
            <option value="ready_to_move" @selected(old('possession_status', $p?->possession_status) === 'ready_to_move')>{{ __('Ready to Move') }}</option>
            <option value="under_construction" @selected(old('possession_status', $p?->possession_status) === 'under_construction')>{{ __('Under Construction') }}</option>
        </select>
        <x-input-error :messages="$errors->get('possession_status')" class="mt-1" />
    </div>
</div>

<div class="mt-6">
    <x-primary-button>{{ $p ? __('Update Property') : __('Submit for Approval') }}</x-primary-button>
    <a href="{{ $cancelRoute ?? route('my-properties.index') }}" class="ms-3 text-sm text-gray-500 hover:underline">{{ __('Cancel') }}</a>
</div>
