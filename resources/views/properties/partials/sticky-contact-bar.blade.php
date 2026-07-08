@php
    $whatsapp = $property->user->phone ? preg_replace('/\D/', '', $property->user->phone) : null;
@endphp
<div class="fixed bottom-0 inset-x-0 z-40 bg-white border-t border-gray-200 shadow-lg lg:hidden">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-3">
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-800 truncate">{{ $property->user->name }}</p>
            <p class="text-xs text-gray-400">{{ __('Property Owner') }}</p>
        </div>
        @if ($property->user->phone)
            <a href="tel:{{ $property->user->phone }}" class="w-10 h-10 rounded-full bg-brand-600 text-white flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
            </a>
        @endif
        @if ($whatsapp)
            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.94 11.94 0 0012.04 0C5.5 0 .2 5.3.2 11.84c0 2.09.55 4.13 1.6 5.93L0 24l6.4-1.68a11.86 11.86 0 005.64 1.44h.01c6.54 0 11.85-5.3 11.85-11.84 0-3.16-1.23-6.13-3.38-8.44zM12.05 21.3a9.4 9.4 0 01-4.8-1.31l-.34-.2-3.57.94.95-3.48-.22-.36a9.45 9.45 0 1117.94-4.05c0 5.22-4.25 9.46-9.96 9.46z" /></svg>
            </a>
        @endif
        <a href="#enquiry-form" class="bg-midnight-950 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shrink-0">
            {{ __('Schedule Visit') }}
        </a>
    </div>
</div>
