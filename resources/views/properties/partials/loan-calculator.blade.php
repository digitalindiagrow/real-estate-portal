<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5"
    x-data="{
        price: {{ (int) $property->price }},
        downPaymentPct: 20,
        tenureYears: 20,
        ratePct: 8.5,
        get downPayment() { return Math.round(this.price * this.downPaymentPct / 100); },
        get principal() { return this.price - this.downPayment; },
        get emi() {
            const r = this.ratePct / 12 / 100;
            const n = this.tenureYears * 12;
            if (r === 0) return Math.round(this.principal / n);
            const f = Math.pow(1 + r, n);
            return Math.round(this.principal * r * f / (f - 1));
        }
    }">
    <h3 class="font-semibold text-gray-800 mb-4">{{ __('Home Loan Calculator') }}</h3>

    <div class="flex items-center justify-between text-sm mb-1">
        <span class="text-gray-500">{{ __('Property Value') }}</span>
        <span class="font-semibold text-gray-800">&#8377;<span x-text="price.toLocaleString('en-IN')"></span></span>
    </div>

    <div class="mt-4">
        <div class="flex items-center justify-between text-sm mb-1">
            <span class="text-gray-500">{{ __('Down Payment') }} (<span x-text="downPaymentPct"></span>%)</span>
            <span class="font-semibold text-gray-800">&#8377;<span x-text="downPayment.toLocaleString('en-IN')"></span></span>
        </div>
        <input type="range" min="5" max="80" step="5" x-model.number="downPaymentPct" class="w-full accent-brand-600">
    </div>

    <div class="mt-4">
        <div class="flex items-center justify-between text-sm mb-1">
            <span class="text-gray-500">{{ __('Loan Tenure') }}</span>
            <span class="font-semibold text-gray-800"><span x-text="tenureYears"></span> {{ __('Years') }}</span>
        </div>
        <input type="range" min="1" max="30" step="1" x-model.number="tenureYears" class="w-full accent-brand-600">
    </div>

    <div class="mt-4">
        <div class="flex items-center justify-between text-sm mb-1">
            <span class="text-gray-500">{{ __('Interest Rate (% p.a.)') }}</span>
            <span class="font-semibold text-gray-800"><span x-text="ratePct"></span>%</span>
        </div>
        <input type="range" min="6" max="15" step="0.1" x-model.number="ratePct" class="w-full accent-brand-600">
    </div>

    <div class="mt-5 bg-brand-50 rounded-lg p-4 text-center">
        <p class="text-xs text-gray-500 uppercase">{{ __('Estimated EMI') }}</p>
        <p class="text-2xl font-extrabold text-brand-700">&#8377;<span x-text="emi.toLocaleString('en-IN')"></span> <span class="text-sm font-medium text-gray-500">/ {{ __('month') }}</span></p>
    </div>

    <a href="{{ route('contact') }}" class="block text-center bg-brand-600 hover:bg-brand-500 text-white text-sm font-semibold py-2.5 rounded-lg mt-4">
        {{ __('Check Loan Eligibility') }}
    </a>
</div>
