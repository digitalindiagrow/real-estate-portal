<x-admin-layout>
    <x-slot name="header">{{ __('Manage Properties') }}</x-slot>

    <div class="flex gap-2 mb-4 text-sm">
        <a href="{{ route('admin.properties.index') }}" class="px-3 py-1.5 rounded-md {{ ! request('status') && ! request('featured_only') ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('All') }}</a>
        <a href="{{ route('admin.properties.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'pending' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Pending') }}</a>
        <a href="{{ route('admin.properties.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'approved' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Approved') }}</a>
        <a href="{{ route('admin.properties.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'rejected' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Rejected') }}</a>
        <a href="{{ route('admin.properties.index', ['featured_only' => 1]) }}" class="px-3 py-1.5 rounded-md {{ request('featured_only') ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Featured') }}</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('Title') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Owner') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('City / Area') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Type') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Price') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Featured') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($properties as $property)
                    <tr>
                        <td class="px-4 py-2">{{ $property->title }}</td>
                        <td class="px-4 py-2">{{ $property->user->name }}</td>
                        <td class="px-4 py-2">{{ $property->area }}, {{ $property->city }}</td>
                        <td class="px-4 py-2 uppercase text-xs">{{ $property->type }}</td>
                        <td class="px-4 py-2">&#8377;{{ number_format($property->price) }}</td>
                        <td class="px-4 py-2">
                            @php
                                $badge = match ($property->status) {
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    default => 'bg-amber-100 text-amber-800',
                                };
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">{{ ucfirst($property->status) }}</span>
                        </td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('admin.properties.feature', $property) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs px-2 py-1 rounded-full {{ $property->is_featured ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $property->is_featured ? __('Featured') : __('Feature') }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.properties.edit', $property) }}" class="text-indigo-600 hover:underline">{{ __('Edit') }}</a>
                            @if ($property->status !== 'approved')
                                <form method="POST" action="{{ route('admin.properties.approve', $property) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:underline">{{ __('Approve') }}</button>
                                </form>
                            @endif
                            @if ($property->status !== 'rejected')
                                <form method="POST" action="{{ route('admin.properties.reject', $property) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-amber-600 hover:underline">{{ __('Reject') }}</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.properties.destroy', $property) }}" class="inline"
                                onsubmit="return confirm('{{ __('Delete this property?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">{{ __('No properties found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $properties->links() }}
    </div>
</x-admin-layout>
