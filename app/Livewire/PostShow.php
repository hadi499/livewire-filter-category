<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public $slug;
    public Comment $comment;
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = Post::with('author')->where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.post-show', [
            'post' => $this->post,

        ]);
    }
}
