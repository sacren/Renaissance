<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('All Posts')]
class PostList extends Component
{
    public function editPost()
    {
    }

    public function deletePost(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
    }

    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::all(),
        ]);
    }
}
