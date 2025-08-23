<?php

namespace App\Livewire;

use Livewire\Component;

class PostManager extends Component
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
        return view('livewire.post-manager');
    }
}
