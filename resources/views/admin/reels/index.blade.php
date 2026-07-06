<x-admin-layout>
    <x-slot name="header">{{ __('Manage Reels') }}</x-slot>

    <div class="flex gap-2 mb-4 text-sm">
        <a href="{{ route('admin.reels.index') }}" class="px-3 py-1.5 rounded-md {{ ! request('status') && ! request('featured_only') ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('All') }}</a>
        <a href="{{ route('admin.reels.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'pending' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Pending') }}</a>
        <a href="{{ route('admin.reels.index', ['status' => 'approved']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'approved' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Approved') }}</a>
        <a href="{{ route('admin.reels.index', ['status' => 'rejected']) }}" class="px-3 py-1.5 rounded-md {{ request('status') === 'rejected' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Rejected') }}</a>
        <a href="{{ route('admin.reels.index', ['featured_only' => 1]) }}" class="px-3 py-1.5 rounded-md {{ request('featured_only') ? 'bg-gray-800 text-white' : 'bg-white text-gray-600' }}">{{ __('Featured') }}</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('Property') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Owner') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Likes') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Comments') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Featured') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($reels as $reel)
                    <tr>
                        <td class="px-4 py-2">
                            <a href="{{ Storage::url($reel->video_path) }}" target="_blank" class="text-indigo-600 hover:underline">
                                {{ $reel->property->title }}
                            </a>
                        </td>
                        <td class="px-4 py-2">{{ $reel->user->name }}</td>
                        <td class="px-4 py-2">
                            @php
                                $badge = match ($reel->status) {
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    default => 'bg-amber-100 text-amber-800',
                                };
                            @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">{{ ucfirst($reel->status) }}</span>
                        </td>
                        <td class="px-4 py-2">{{ $reel->likes_count }}</td>
                        <td class="px-4 py-2">
                            @if ($reel->comments_count)
                                <details>
                                    <summary class="cursor-pointer text-indigo-600">{{ $reel->comments_count }}</summary>
                                    <div class="mt-2 space-y-1 max-w-xs">
                                        @foreach ($reel->comments as $comment)
                                            <div class="flex items-center justify-between text-xs bg-gray-50 rounded px-2 py-1">
                                                <span><span class="font-medium">{{ $comment->user->name }}:</span> {{ $comment->body }}</span>
                                                <form method="POST" action="{{ route('admin.reels.comments.destroy', $comment) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 ms-2">&times;</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            @else
                                0
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('admin.reels.feature', $reel) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs px-2 py-1 rounded-full {{ $reel->is_featured ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $reel->is_featured ? __('Featured') : __('Feature') }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2 space-x-2 whitespace-nowrap">
                            @if ($reel->status !== 'approved')
                                <form method="POST" action="{{ route('admin.reels.approve', $reel) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-600 hover:underline">{{ __('Approve') }}</button>
                                </form>
                            @endif
                            @if ($reel->status !== 'rejected')
                                <form method="POST" action="{{ route('admin.reels.reject', $reel) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-amber-600 hover:underline">{{ __('Reject') }}</button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.reels.destroy', $reel) }}" class="inline"
                                onsubmit="return confirm('{{ __('Delete this reel?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">{{ __('No reels found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reels->links() }}
    </div>
</x-admin-layout>
