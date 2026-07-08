<?php

namespace App\Http\Controllers;

use App\Mail\PropertyEnquiryMail;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PropertyEnquiryController extends Controller
{
    public function store(Request $request, Property $property): RedirectResponse
    {
        abort_unless($property->status === 'approved', 404);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        Mail::to($property->user->email)->send(new PropertyEnquiryMail(
            $property,
            $data['name'],
            $data['phone'],
            $data['message'] ?? null,
        ));

        return back()->with('status', 'Your enquiry has been sent to the owner.');
    }
}
