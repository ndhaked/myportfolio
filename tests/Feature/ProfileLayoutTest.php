<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_shows_the_panel_sidebar(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->get('/admin/profile')
            ->assertOk()
            ->assertSee('Profile Information')
            ->assertSee('Dashboard');
    }
}
