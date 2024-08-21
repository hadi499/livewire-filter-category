<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostComment extends Component
{

    public $comment;
    public $post;
    public $body;


    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function redirectToLogin()
    {
        return redirect()->route('login');
    }

    public function store()
    {
        $this->validate(['body' => 'required']);
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id,
            'body' => $this->body
        ]);

        $this->body = NULL;
    }

    public function render()
    {
        $comments = Comment::with('user')
            ->where('post_id', $this->post->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $total_comment = Comment::where('post_id', $this->post->id)->count();
        return view('livewire.post-comment', [
            'comments' => $comments,
            'total_comment' => $total_comment
        ]);
    }
}
