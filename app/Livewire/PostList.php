<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

class PostList extends Component
{
    use WithPagination;

    public $filterCategory;

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    #[Computed()]
    public function posts()
    {
        return Post::when($this->activeCategory, function ($query) {
            $query->withCategory($this->category);
        })
            ->where('title', 'like', "%{$this->search}%")
            ->latest()->paginate(3);
    }

    #[Computed()]
    public function activeCategory()
    {
        if ($this->category === null || $this->category === '') {
            return null;
        }

        return Category::where('slug', $this->category)->first();
    }



    public function render()
    {
        $this->filterCategory = Category::all();
        return view('livewire.post-list', [
            'categories' => $this->filterCategory
        ]);
    }
}
