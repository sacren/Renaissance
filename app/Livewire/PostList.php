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
    public $editPostId = null;

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

    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        if (! $post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $this->authorize('update', $post);
        $this->title = $post->title;
        $this->content = $post->content;
        $this->editPostId = $id;
    }

    public function updatePost()
    {
        $this->validate();

        $post = Post::find($this->editPostId);

        if (! $post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $this->authorize('update', $post);

        $post->update([
            'title' => $this->title,
            'content'  => $this->content,
        ]);

        session()->flash('success', 'Post updated successfully!');

        $this->reset(['title', 'content', 'editPostId']);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);

        if (! $post) {
            session()->flash('error', 'Post not found.');
            return;
        }

        $this->authorize('delete', $post);
        $post->delete();
        session()->flash('success', 'Post deleted successfully!');
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
    }

    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::all(),
        ]);
    }
}
