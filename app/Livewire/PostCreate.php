<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PostCreate extends Component
{

    use WithFileUploads;
    public $title;
    public $slug;
    public $image;

    public $body;
    public $categories;
    public $selectedCategories = [];




    protected $rules = [
        'title' => 'required|max:255|unique:posts',
        'slug' => 'required|unique:posts',
        'image' => 'image|file|max:1024|nullable',
        'body' => 'required',
        'selectedCategories' => 'required|array',
    ];

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->image) {
            $validatedData['image'] = $this->image->store('posts');
        }

        $validatedData['user_id'] = auth()->user()->id;
        unset($validatedData['selectedCategories']);


        $post = Post::create($validatedData);
        $post->categories()->attach($this->selectedCategories);


        session()->flash('success', 'New post added!');
        return redirect()->route('dashboard');
    }
    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.post-create', [
            'categories' => $this->categories,
        ]);
    }
}
