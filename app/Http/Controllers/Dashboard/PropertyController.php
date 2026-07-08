<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $properties = $request->user()->properties()->latest()->paginate(10);

        return view('dashboard.properties.index', compact('properties'));
    }

    public function create(): View
    {
        return view('dashboard.properties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Property::class);

        $data = $this->validateProperty($request);
        $data['user_id'] = $request->user()->id;
        $data['status'] = 'pending';

        Property::create($data);

        return redirect()->route('my-properties.index')->with('status', 'Property submitted for admin approval.');
    }

    public function edit(Property $property): View
    {
        $this->authorize('update', $property);

        return view('dashboard.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $this->authorize('update', $property);

        $data = $this->validateProperty($request);
        $data['status'] = 'pending';
        $data['rejection_reason'] = null;

        $property->update($data);

        return redirect()->route('my-properties.index')->with('status', 'Property updated and resubmitted for approval.');
    }

    public function destroy(Property $property): RedirectResponse
    {
        $this->authorize('delete', $property);

        $property->delete();

        return redirect()->route('my-properties.index')->with('status', 'Property deleted.');
    }

    private function validateProperty(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:sale,rent'],
            'category' => ['required', 'in:apartment,villa,independent_house,plot,penthouse,studio_apartment'],
            'price' => ['required', 'numeric', 'min:0'],
            'city' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'size_sqft' => ['nullable', 'integer', 'min:0'],
            'furnishing' => ['nullable', 'in:furnished,semi_furnished,unfurnished'],
            'preferred_for' => ['nullable', 'in:family,bachelor,company_lease'],
            'possession_status' => ['nullable', 'in:ready_to_move,under_construction'],
        ]);
    }
}
