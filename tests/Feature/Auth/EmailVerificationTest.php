<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified_with_correct_otp(): void
    {
        $user = User::factory()->unverified()->create();
        $code = $user->generateOtp();

        Event::fake();

        $response = $this->actingAs($user)->post('/verify-email', ['code' => $code]);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_email_is_not_verified_with_incorrect_otp(): void
    {
        $user = User::factory()->unverified()->create();
        $user->generateOtp();

        $this->actingAs($user)->post('/verify-email', ['code' => '000000']);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }

    public function test_email_is_not_verified_with_expired_otp(): void
    {
        $user = User::factory()->unverified()->create();
        $code = $user->generateOtp();
        $user->forceFill(['otp_expires_at' => now()->subMinute()])->save();

        $this->actingAs($user)->post('/verify-email', ['code' => $code]);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}
