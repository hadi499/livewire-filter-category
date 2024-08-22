<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;


class PostDestroy extends Component
{
    public $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }


    public function destroy()
    {
        // if ($this->post->image) {
        //     Storage::delete($this->post->image);
        // }
        $this->post->delete();
        $this->confirmingDelete = false;
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.post-destroy');
    }
}
