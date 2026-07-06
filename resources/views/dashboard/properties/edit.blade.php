<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Property') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if ($property->status === 'rejected' && $property->rejection_reason)
                    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-md mb-4">
                        {{ __('Rejected reason') }}: {{ $property->rejection_reason }}
                    </div>
                @endif
                <p class="text-sm text-gray-500 mb-4">{{ __('Editing will resubmit this property for admin approval.') }}</p>
                <form method="POST" action="{{ route('my-properties.update', $property) }}">
                    @csrf
                    @method('PUT')
                    @include('dashboard.properties._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
