<?php

use App\Models\Contact;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $body = '';
    public bool $compact = false;
    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'body' => 'required|string',
        ];
    }

    public function send(): void
    {
        $this->sent = false;

        $validated = $this->validate();

        Contact::create([
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => 'Contact Us',
            'message' => $validated['body'],
        ]);

        $this->reset(['name', 'email', 'phone', 'body']);
        $this->sent = true;
    }
}; ?>

@php
    $labelCols = $compact ? 3 : 2;
    $fieldCols = $compact ? 9 : 10;
@endphp

<form wire:submit="send" class="form-horizontal contact-form">
    <div class="form-group">
        <label class="col-sm-{{ $labelCols }} control-label">Name</label>
        <div class="col-sm-{{ $fieldCols }}">
            <input type="text" class="contact-name" wire:model="name" />
            @error('name') <span class="help-block" style="color:#e74c3c;">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-{{ $labelCols }} control-label">Email</label>
        <div class="col-sm-{{ $fieldCols }}">
            <input type="email" class="contact-email" wire:model="email" />
            @error('email') <span class="help-block" style="color:#e74c3c;">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-{{ $labelCols }} control-label">Phone</label>
        <div class="col-sm-{{ $fieldCols }}">
            <input type="text" class="contact-phone" wire:model="phone" />
            @error('phone') <span class="help-block" style="color:#e74c3c;">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-{{ $labelCols }} control-label">Message</label>
        <div class="col-sm-{{ $fieldCols }}">
            <textarea wire:model="body" class="contact-message" rows="3"></textarea>
            @error('body') <span class="help-block" style="color:#e74c3c;">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-{{ $fieldCols }} col-sm-offset-{{ $labelCols }}">
            <button type="submit" class="button solid-button purple" wire:loading.attr="disabled" wire:target="send">
                <span wire:loading.remove wire:target="send">Send Message</span>
                <span wire:loading wire:target="send">Sending...</span>
            </button>
        </div>
    </div>

    <div wire:loading wire:target="send" class="contact-loading alert alert-info form-alert">
        <span class="message">Sending Request...</span>
    </div>
    @if ($sent)
        <div class="contact-success alert alert-success form-alert">
            <span class="message">Success! Thanks for contacting me &mdash; I'll get back to you soon.</span>
            <button type="button" class="close" wire:click="$set('sent', false)">&times;</button>
        </div>
    @endif
</form>
