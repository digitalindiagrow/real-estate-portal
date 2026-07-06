<x-admin-layout>
    <x-slot name="header">{{ __('Dashboard') }}</x-slot>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Total Users') }}</div>
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-red-600">{{ $stats['blocked_users'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Blocked Users') }}</div>
        </a>
        <a href="{{ route('admin.properties.index') }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['total_properties'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Total Properties') }}</div>
        </a>
        <a href="{{ route('admin.properties.index', ['status' => 'pending']) }}" class="bg-amber-50 border border-amber-200 rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-amber-700">{{ $stats['pending_properties'] }}</div>
            <div class="text-sm text-amber-700">{{ __('Pending Approvals') }}</div>
        </a>
        <a href="{{ route('admin.properties.index', ['status' => 'approved']) }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-green-600">{{ $stats['approved_properties'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Approved') }}</div>
        </a>
        <a href="{{ route('admin.properties.index', ['status' => 'rejected']) }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-red-600">{{ $stats['rejected_properties'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Rejected') }}</div>
        </a>
        <a href="{{ route('admin.properties.index', ['featured_only' => 1]) }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-indigo-600">{{ $stats['featured_properties'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Featured') }}</div>
        </a>
        <a href="{{ route('admin.reels.index') }}" class="bg-white rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-gray-800">{{ $stats['total_reels'] }}</div>
            <div class="text-sm text-gray-500">{{ __('Total Reels') }}</div>
        </a>
        <a href="{{ route('admin.reels.index', ['status' => 'pending']) }}" class="bg-amber-50 border border-amber-200 rounded-lg shadow p-4">
            <div class="text-2xl font-bold text-amber-700">{{ $stats['pending_reels'] }}</div>
            <div class="text-sm text-amber-700">{{ __('Pending Reels') }}</div>
        </a>
    </div>

    <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-5 mb-8 text-sm text-gray-700 space-y-1">
        <p class="font-semibold text-indigo-800 mb-2">{{ __('Ye kaise kaam karta hai:') }}</p>
        <p>{{ __("Jab koi user naya property post karta hai, wo yahan 'Pending' mein aata hai. Aap use Approve ya Reject kar sakte hain.") }}</p>
        <p>{{ __("Kisi approved property ko 'Feature' karke homepage par highlight kiya ja sakta hai.") }}</p>
        <p>{{ __('Kisi user ko block karne se wo login nahi kar payega, lekin uski properties list mein rahengi.') }}</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b font-semibold text-gray-800">{{ __('Recent Pending Properties') }}</div>
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('Title') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Owner') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('City / Area') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($recentPending as $property)
                    <tr>
                        <td class="px-4 py-2">{{ $property->title }}</td>
                        <td class="px-4 py-2">{{ $property->user->name }}</td>
                        <td class="px-4 py-2">{{ $property->area }}, {{ $property->city }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <form method="POST" action="{{ route('admin.properties.approve', $property) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-green-600 hover:underline">{{ __('Approve') }}</button>
                            </form>
                            <form method="POST" action="{{ route('admin.properties.reject', $property) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-600 hover:underline">{{ __('Reject') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">{{ __('No pending properties right now.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
