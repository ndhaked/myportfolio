<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\TestCase;

class PortfolioAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_the_portfolio_admin_page(): void
    {
        $this->get('/admin/portfolio')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_the_portfolio_admin_page(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->get('/admin/portfolio')
            ->assertOk()
            ->assertSee('My Portfolio');
    }

    public function test_it_creates_a_portfolio_item_with_photo_via_the_repository(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        Volt::test('admin.portfolio-manager')
            ->call('create')
            ->set('title', 'CRM System')
            ->set('description', 'A custom CRM')
            ->set('technologiesInput', 'Laravel, Vue.js, MySQL')
            ->set('website_url', 'https://example.com')
            ->set('photo', UploadedFile::fake()->image('project.jpg'))
            ->call('save')
            ->assertHasNoErrors();

        $portfolio = Portfolio::first();

        $this->assertNotNull($portfolio);
        $this->assertSame('CRM System', $portfolio->title);
        $this->assertSame(['Laravel', 'Vue.js', 'MySQL'], $portfolio->technologies);
        Storage::disk('public')->assertExists($portfolio->photo);
    }

    public function test_it_updates_a_portfolio_item(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        $portfolio = Portfolio::create([
            'title' => 'Old Title',
            'technologies' => ['PHP'],
        ]);

        Volt::test('admin.portfolio-manager')
            ->call('edit', $portfolio->id)
            ->set('title', 'New Title')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('New Title', $portfolio->fresh()->title);
    }

    public function test_it_deletes_a_portfolio_item(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);

        $portfolio = Portfolio::create(['title' => 'To Delete']);

        Volt::test('admin.portfolio-manager')->call('delete', $portfolio->id);

        $this->assertNull(Portfolio::find($portfolio->id));
    }

    public function test_homepage_lists_portfolio_projects(): void
    {
        Portfolio::create([
            'title' => 'Public Project',
            'technologies' => ['Laravel'],
        ]);

        $this->get('/')->assertSee('Public Project');
    }
}
