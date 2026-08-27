<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Volt\Volt;
use Tests\TestCase;

class LivewireVerifyTest extends TestCase
{
    use RefreshDatabase;

    public function test_submits_the_contact_form_via_livewire(): void
    {
        Volt::test('contact-form')
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('phone', '9999999999')
            ->set('body', 'Hello from a Livewire test')
            ->call('send')
            ->assertHasNoErrors();

        $this->assertTrue(Contact::where('email', 'jane@example.com')->exists());
    }

    public function test_validates_the_contact_form_via_livewire(): void
    {
        Volt::test('contact-form')
            ->set('email', 'not-an-email')
            ->call('send')
            ->assertHasErrors(['name', 'email', 'body']);
    }

    public function test_responds_to_a_chatbot_message_via_livewire(): void
    {
        Volt::test('chatbot-widget')
            ->set('input', 'tell me about your skills')
            ->call('send')
            ->assertSet('input', '');
    }
}
