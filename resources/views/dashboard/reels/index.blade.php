<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('My Reels') }}</h2>
            <a href="{{ route('my-reels.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-500">
                {{ __('+ Upload Reel') }}
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
                            <th class="px-4 py-2 text-left">{{ __('Property') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Likes') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Comments') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($reels as $reel)
                            <tr>
                                <td class="px-4 py-2">{{ $reel->property->title }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $badge = match ($reel->status) {
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            default => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">{{ ucfirst($reel->status) }}</span>
                                    @if ($reel->status === 'rejected' && $reel->rejection_reason)
                                        <div class="text-xs text-gray-500 mt-1">{{ $reel->rejection_reason }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $reel->likes_count }}</td>
                                <td class="px-4 py-2">{{ $reel->comments_count }}</td>
                                <td class="px-4 py-2">
                                    <form method="POST" action="{{ route('my-reels.destroy', $reel) }}" class="inline"
                                        onsubmit="return confirm('{{ __('Delete this reel?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    {{ __("You haven't uploaded any reels yet.") }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reels->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
