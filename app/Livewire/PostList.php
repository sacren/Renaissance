<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('All Posts')]
class PostList extends Component
{
    public $title = '';
    public $content = '';

    protected $rules = [
        'title' => [
            'required',
            'min:3',
            'max:255',
        ],

        'content'  => [
            'required',
            'min:10',
        ],
    ];

    public function editPost()
    {
    }

    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }

    public function savePost()
    {
        $this->validate();

        auth()->user()->posts()->create([
            'title' => $this->title,
            'content'  => $this->content,
        ]);

        // Flash message (optional, for UX)
        session()->flash('message', 'Post created successfully!');

        // Reset form fields
        $this->reset(['title', 'content']);

        // Optionally emit an event so other components (like PostList) can react
        $this->dispatch('post-created');
    }

    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::all(),
        ]);
    }
}
