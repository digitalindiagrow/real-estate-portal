<?php

namespace Tests\Feature\Reels;

use App\Models\Property;
use App\Models\Reel;
use App\Models\ReelComment;
use App\Models\ReelLike;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ReelUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_upload_a_reel_for_their_own_approved_property(): void
    {
        Storage::fake('public');

        $seller = User::factory()->create();
        $property = Property::factory()->for($seller)->create(['status' => 'approved']);

        $response = $this->actingAs($seller)->post('/my-reels', [
            'property_id' => $property->id,
            'video' => UploadedFile::fake()->create('clip.mp4', 2000, 'video/mp4'),
            'duration_seconds' => 30,
        ]);

        $response->assertRedirect(route('my-reels.index'));

        $reel = Reel::first();
        $this->assertNotNull($reel);
        $this->assertSame('pending', $reel->status);
        $this->assertSame($seller->id, $reel->user_id);
        Storage::disk('public')->assertExists($reel->video_path);
    }

    public function test_user_cannot_upload_a_reel_for_someone_elses_property(): void
    {
        Storage::fake('public');

        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $property = Property::factory()->for($owner)->create(['status' => 'approved']);

        $response = $this->actingAs($otherUser)->post('/my-reels', [
            'property_id' => $property->id,
            'video' => UploadedFile::fake()->create('clip.mp4', 2000, 'video/mp4'),
        ]);

        $response->assertSessionHasErrors('property_id');
        $this->assertDatabaseCount('reels', 0);
    }

    public function test_admin_can_approve_and_feature_a_reel_and_it_appears_publicly(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $seller = User::factory()->create();
        $property = Property::factory()->for($seller)->create(['status' => 'approved']);
        $reel = Reel::factory()->for($seller)->for($property)->create(['status' => 'pending']);

        $this->actingAs($admin)->patch(route('admin.reels.approve', $reel))->assertRedirect();
        $this->actingAs($admin)->patch(route('admin.reels.feature', $reel))->assertRedirect();

        $reel->refresh();
        $this->assertSame('approved', $reel->status);
        $this->assertTrue($reel->is_featured);

        $this->get(route('reels.index'))->assertSee($property->title);
    }

    public function test_authenticated_user_can_like_and_comment_on_an_approved_reel(): void
    {
        $seller = User::factory()->create();
        $buyer = User::factory()->create();
        $property = Property::factory()->for($seller)->create(['status' => 'approved']);
        $reel = Reel::factory()->for($seller)->for($property)->create(['status' => 'approved']);

        $this->actingAs($buyer)->post(route('reels.like', $reel))->assertRedirect();
        $this->assertDatabaseHas('reel_likes', ['user_id' => $buyer->id, 'reel_id' => $reel->id]);

        // Toggling again removes the like.
        $this->actingAs($buyer)->post(route('reels.like', $reel))->assertRedirect();
        $this->assertDatabaseMissing('reel_likes', ['user_id' => $buyer->id, 'reel_id' => $reel->id]);

        $this->actingAs($buyer)->post(route('reels.comments.store', $reel), ['body' => 'Nice place!'])->assertRedirect();
        $this->assertDatabaseHas('reel_comments', ['reel_id' => $reel->id, 'body' => 'Nice place!']);
    }

    public function test_owner_or_admin_can_delete_a_reel_but_other_users_cannot(): void
    {
        Storage::fake('public');

        $seller = User::factory()->create();
        $otherUser = User::factory()->create();
        $property = Property::factory()->for($seller)->create(['status' => 'approved']);
        $reel = Reel::factory()->for($seller)->for($property)->create();

        $this->actingAs($otherUser)->delete(route('my-reels.destroy', $reel))->assertForbidden();
        $this->assertDatabaseHas('reels', ['id' => $reel->id]);

        $this->actingAs($seller)->delete(route('my-reels.destroy', $reel))->assertRedirect();
        $this->assertDatabaseMissing('reels', ['id' => $reel->id]);
    }
}
