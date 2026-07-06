<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Upload Reel') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if ($properties->isEmpty())
                    <p class="text-gray-500">
                        {{ __('You need at least one approved property before you can upload a reel.') }}
                        <a href="{{ route('my-properties.create') }}" class="text-indigo-600 hover:underline">{{ __('Add a property') }}</a>
                    </p>
                @else
                    <form method="POST" action="{{ route('my-reels.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="property_id" :value="__('Property')" />
                            <select id="property_id" name="property_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}" @selected(old('property_id') == $property->id)>
                                        {{ $property->title }} ({{ $property->area }}, {{ $property->city }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('property_id')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="video" :value="__('Video file (mp4/webm/mov, max 50MB)')" />
                            <input id="video" name="video" type="file" accept="video/*" class="mt-1 block w-full" required>
                            <x-input-error :messages="$errors->get('video')" class="mt-1" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="thumbnail" :value="__('Thumbnail image (optional)')" />
                            <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="mt-1 block w-full">
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-1" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="duration_seconds" :value="__('Duration in seconds (optional)')" />
                            <x-text-input id="duration_seconds" name="duration_seconds" type="number" class="mt-1 block w-full" value="{{ old('duration_seconds') }}" />
                            <x-input-error :messages="$errors->get('duration_seconds')" class="mt-1" />
                        </div>

                        <x-primary-button>{{ __('Submit for Approval') }}</x-primary-button>
                        <a href="{{ route('my-reels.index') }}" class="ms-3 text-sm text-gray-500 hover:underline">{{ __('Cancel') }}</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
