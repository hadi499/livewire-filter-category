<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;

    public $post;
    public $title;
    public $slug;
    public $image;
    public $body;
    public $categories;
    public $selectedCategories = [];
    public $existingImage;

    protected $rules = [
        'title' => 'required|max:255',
        'slug' => 'required|unique:posts,slug,{{postId}}',
        'image' => 'image|file|max:1024|nullable',
        'body' => 'required',
        'selectedCategories' => 'required|array',
    ];

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
        $this->title = $this->post->title;
        $this->slug = $this->post->slug;
        $this->body = $this->post->body;
        $this->selectedCategories = $this->post->categories->pluck('id')->toArray();
        $this->existingImage = $this->post->image;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function cancel()
    {
        return redirect()->route('dashboard');
    }

    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required|max:255|unique:posts',
            'image' => 'image|file|max:1024|nullable',
            'body' => 'required',
            'selectedCategories' => 'required|array',
        ]);



        if ($this->image) {
            $validatedData['image'] = $this->image->store('posts');
        } else {
            $validatedData['image'] = $this->existingImage;
        }

        $validatedData['user_id'] = auth()->user()->id;
        unset($validatedData['selectedCategories']);

        $this->post->update($validatedData);

        // Update categories
        $this->post->categories()->sync($this->selectedCategories);

        session()->flash('success', 'Post updated successfully!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.post-edit', [
            'categories' => $this->categories,
        ]);
    }
}
