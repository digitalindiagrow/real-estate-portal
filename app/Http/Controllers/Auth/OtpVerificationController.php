<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpCodeMail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpVerificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $isValid = $user->otp_code === $request->input('code')
            && $user->otp_expires_at
            && $user->otp_expires_at->isFuture();

        if (! $isValid) {
            return back()->withErrors(['code' => 'Invalid or expired code.']);
        }

        $user->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
        ])->save();

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect()->route('dashboard')->with('status', 'Email verified successfully.');
    }

    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $code = $user->generateOtp();
        Mail::to($user)->send(new OtpCodeMail($user, $code));

        return back()->with('status', 'otp-resent');
    }
}
