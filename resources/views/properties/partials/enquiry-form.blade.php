<div id="enquiry-form" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
    <h3 class="font-semibold text-gray-800 mb-1">{{ __('Send Enquiry') }}</h3>
    <p class="text-xs text-gray-400 mb-4">{{ __('We\'ll pass your details directly to the owner.') }}</p>

    @if (session('status'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-md px-3 py-2 mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('properties.enquiry', $property) }}" class="space-y-3">
        @csrf
        <div>
            <input type="text" name="name" placeholder="{{ __('Full Name') }}" value="{{ old('name') }}" required
                class="w-full text-sm rounded-md border-gray-300">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>
        <div>
            <input type="text" name="phone" placeholder="{{ __('Mobile Number') }}" value="{{ old('phone') }}" required
                class="w-full text-sm rounded-md border-gray-300">
            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
        </div>
        <div>
            <textarea name="message" rows="3" placeholder="{{ __('Add a message (optional)') }}"
                class="w-full text-sm rounded-md border-gray-300">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-1" />
        </div>
        <button type="submit" class="w-full bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg">
            {{ __('Send Enquiry') }}
        </button>
        <p class="text-[11px] text-gray-400 text-center">
            {{ __('By submitting, you agree to our') }} <a href="{{ route('contact') }}" class="underline">{{ __('Terms') }}</a> {{ __('and') }} <a href="{{ route('contact') }}" class="underline">{{ __('Privacy Policy') }}</a>.
        </p>
    </form>
</div>
