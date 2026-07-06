<x-admin-layout>
    <x-slot name="header">{{ __('Manage Users') }}</x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('Name') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Email') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Role') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Status') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Verified') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Properties') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $user->status === 'blocked' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs px-2 py-1 rounded-full {{ $user->is_verified ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $user->is_verified ? __('Verified') : __('Verify') }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-2">{{ $user->properties_count }}</td>
                        <td class="px-4 py-2 space-x-2">
                            @unless ($user->isAdmin())
                                @if ($user->status === 'blocked')
                                    <form method="POST" action="{{ route('admin.users.unblock', $user) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:underline">{{ __('Unblock') }}</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.users.block', $user) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-amber-600 hover:underline">{{ __('Block') }}</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"
                                    onsubmit="return confirm('{{ __('Delete this user?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs">{{ __('Admin') }}</span>
                            @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</x-admin-layout>
