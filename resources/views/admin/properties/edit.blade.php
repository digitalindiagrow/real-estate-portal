<x-admin-layout>
    <x-slot name="header">{{ __('Edit Property') }}</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.properties.update', $property) }}">
            @csrf
            @method('PUT')
            @include('dashboard.properties._form', ['property' => $property, 'cancelRoute' => route('admin.properties.index')])
        </form>
    </div>
</x-admin-layout>
