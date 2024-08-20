<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategorySelect extends Component
{
    public $selectedCategories = [];
    public $search = '';

    public function render()
    {
        $categories = Category::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();

        return view('livewire.category-select', [
            'categories' => $categories,
        ]);
    }
}
