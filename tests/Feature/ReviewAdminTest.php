<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ReviewAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_the_reviews_admin_page(): void
    {
        $this->get('/admin/reviews')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_the_reviews_admin_page(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->get('/admin/reviews')
            ->assertOk()
            ->assertSee('Reviews');
    }

    public function test_it_creates_a_review_and_extracts_the_youtube_id_from_a_full_url(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        Volt::test('admin.review-manager')
            ->call('create')
            ->set('client_name', 'Jane Client')
            ->set('client_role', 'CEO, Example Co')
            ->set('quote', 'Great work.')
            ->set('youtube_input', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->call('save')
            ->assertHasNoErrors();

        $review = Review::first();

        $this->assertNotNull($review);
        $this->assertSame('Jane Client', $review->client_name);
        $this->assertSame('dQw4w9WgXcQ', $review->youtube_video_id);
    }

    public function test_it_rejects_an_unrecognized_youtube_input(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        Volt::test('admin.review-manager')
            ->call('create')
            ->set('client_name', 'Jane Client')
            ->set('youtube_input', 'not-a-youtube-link')
            ->call('save')
            ->assertHasErrors(['youtube_input']);

        $this->assertNull(Review::first());
    }

    public function test_it_updates_a_review(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        $review = Review::create(['client_name' => 'Old Name']);

        Volt::test('admin.review-manager')
            ->call('edit', $review->id)
            ->set('client_name', 'New Name')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('New Name', $review->fresh()->client_name);
    }

    public function test_it_deletes_a_review(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        $review = Review::create(['client_name' => 'To Delete']);

        Volt::test('admin.review-manager')->call('delete', $review->id);

        $this->assertNull(Review::find($review->id));
    }

    public function test_homepage_lists_reviews(): void
    {
        Review::create([
            'client_name' => 'Public Client',
            'client_role' => 'Owner, Public Co',
            'quote' => 'Loved it.',
            'youtube_video_id' => 'dQw4w9WgXcQ',
        ]);

        $this->get('/')->assertSee('Public Client');
    }

    public function test_new_reviews_default_to_active(): void
    {
        $review = Review::create(['client_name' => 'Default Status']);

        $this->assertTrue($review->fresh()->is_active);
    }

    public function test_it_toggles_a_review_active_status(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        $review = Review::create(['client_name' => 'Toggle Me', 'is_active' => true]);

        Volt::test('admin.review-manager')->call('toggleActive', $review->id);
        $this->assertFalse($review->fresh()->is_active);

        Volt::test('admin.review-manager')->call('toggleActive', $review->id);
        $this->assertTrue($review->fresh()->is_active);
    }

    public function test_homepage_only_shows_active_reviews_and_keeps_inactive_ones_in_the_database(): void
    {
        Review::create(['client_name' => 'Visible Client', 'is_active' => true]);
        Review::create(['client_name' => 'Hidden Client', 'is_active' => false]);

        $this->get('/')
            ->assertSee('Visible Client')
            ->assertDontSee('Hidden Client');

        $this->assertSame(2, Review::count());
    }

    public function test_admin_list_shows_both_active_and_inactive_reviews(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        Review::create(['client_name' => 'Visible Client', 'is_active' => true]);
        Review::create(['client_name' => 'Hidden Client', 'is_active' => false]);

        $this->actingAs($user)
            ->get('/admin/reviews')
            ->assertSee('Visible Client')
            ->assertSee('Hidden Client');
    }
}
