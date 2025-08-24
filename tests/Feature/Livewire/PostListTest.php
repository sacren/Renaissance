<?php

use App\Livewire\PostList;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\{actingAs};

// Test that component renders
it('can render the post list', function () {
    Livewire::test(PostList::class)
        ->assertStatus(200);
});

// Test that posts are shown
it('displays all posts', function () {
    $posts = Post::factory()->count(3)->create();

    $component = Livewire::test(PostList::class);

    foreach ($posts as $post) {
        $component->assertSee($post->title);
    }
});

// Test that each post shows author and content
it('displays post details', function () {
    $user = User::factory()->create(['name' => 'John Doe']);
    $post = Post::factory()->for($user)->create([
        'title' => 'My First Post',
        'content' => 'This is the content of my first post.',
    ]);

    Livewire::test(PostList::class)
        ->assertSee($post->title)
        ->assertSee('John Doe')
        ->assertSee($post->content);
});

// Test delete action - authorized user
it('allows authorized user to delete a post', function () {
    $user = User::factory()->create(['id' => 1]); // matches policy
    actingAs($user);

    $post = Post::factory()->for($user)->create();

    Livewire::test(PostList::class)
        ->call('deletePost', $post);

    $this->assertModelMissing($post);
});

// Test delete action - unauthorized user
it('prevents unauthorized user from deleting a post', function () {
    $user = User::factory()->create(['id' => 999]); // does NOT match policy
    actingAs($user);

    $owner = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    // Expect a 403 forbidden response
    Livewire::test(PostList::class)
        ->call('deletePost', $post)
        ->assertStatus(403); // or assertForbidden()

    $this->assertModelExists($post); // post still exists
});
