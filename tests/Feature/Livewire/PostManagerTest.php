<?php

use App\Livewire\PostManager;
use Livewire\Livewire;

it('renders the post manager form', function () {
    Livewire::test(PostManager::class)
        ->assertSee('Create a New Post')
        ->assertSee('Title')
        ->assertSee('Save Post');
});

it('validates required fields', function () {
    Livewire::test(PostManager::class)
        ->call('savePost')
        ->assertHasErrors(['title', 'content']);
});

it('creates a post when valid data is provided', function () {
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    Livewire::test(PostManager::class)
        ->set('title', 'Hello World')
        ->set('content', 'This is my first post.')
        ->call('savePost')
        ->assertHasNoErrors()
        ->assertDispatched('post-created')
        ->assertSet('title', '')
        ->assertSet('content', '');
});
