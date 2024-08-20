<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PostList extends Component
{


    public function render()
    {
        return view('livewire.post-list', [
            'posts' => Post::query()->with('author')->latest()->get()

        ]);
    }
}
