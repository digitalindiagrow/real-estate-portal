<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('My Properties') }}</h2>
            <a href="{{ route('my-properties.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-500">
                {{ __('+ Add Property') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">{{ __('Title') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('City / Area') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Price') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($properties as $property)
                            <tr>
                                <td class="px-4 py-2">{{ $property->title }}</td>
                                <td class="px-4 py-2">{{ $property->area }}, {{ $property->city }}</td>
                                <td class="px-4 py-2">&#8377;{{ number_format($property->price) }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $badge = match ($property->status) {
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            default => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                                        {{ ucfirst($property->status) }}
                                    </span>
                                    @if ($property->status === 'rejected' && $property->rejection_reason)
                                        <div class="text-xs text-gray-500 mt-1">{{ $property->rejection_reason }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('my-properties.edit', $property) }}" class="text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                                    <form method="POST" action="{{ route('my-properties.destroy', $property) }}" class="inline"
                                        onsubmit="return confirm('{{ __('Delete this property?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    {{ __("You haven't listed any properties yet.") }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $properties->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
