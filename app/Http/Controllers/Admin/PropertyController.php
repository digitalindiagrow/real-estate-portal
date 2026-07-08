<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PropertyController extends Controller
{
    public function index(Request $request): View
    {
        $query = Property::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->boolean('featured_only')) {
            $query->where('is_featured', true);
        }

        $properties = $query->paginate(15)->withQueryString();

        return view('admin.properties.index', compact('properties'));
    }

    public function edit(Property $property): View
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $data = $request->validate([
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

        $property->update($data);

        return redirect()->route('admin.properties.index')->with('status', 'Property updated.');
    }

    public function approve(Property $property): RedirectResponse
    {
        $property->update(['status' => 'approved', 'rejection_reason' => null]);

        return back()->with('status', "Approved \"{$property->title}\".");
    }

    public function reject(Request $request, Property $property): RedirectResponse
    {
        $request->validate(['rejection_reason' => ['nullable', 'string', 'max:255']]);

        $property->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return back()->with('status', "Rejected \"{$property->title}\".");
    }

    public function toggleFeature(Property $property): RedirectResponse
    {
        $property->update(['is_featured' => ! $property->is_featured]);

        $message = $property->is_featured ? 'marked as Featured' : 'removed from Featured';

        return back()->with('status', "\"{$property->title}\" {$message}.");
    }

    public function destroy(Property $property): RedirectResponse
    {
        $property->delete();

        return back()->with('status', "Deleted \"{$property->title}\".");
    }
}
