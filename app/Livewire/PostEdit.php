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


    public $postId;
    public $title;
    public $slug;
    public $image;
    public $body;
    public $categories;
    public $selectedCategories = [];
    public $existingImage;



    public function mount($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->body = $post->body;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
        $this->existingImage = $post->image;
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
            'title' => 'required|unique:posts,title,' . $this->postId,
            'image' => 'image|file|max:1024|nullable',
            'body' => 'required',
            'selectedCategories' => 'required|array',
        ]);

        $post = Post::findOrFail($this->postId);

        if ($this->image) {
            $validatedData['image'] = $this->image->store('posts');
        } else {
            $validatedData['image'] = $this->existingImage;
        }

        $validatedData['user_id'] = auth()->user()->id;
        unset($validatedData['selectedCategories']);

        $post->update($validatedData);

        // Update categories
        $post->categories()->sync($this->selectedCategories);

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
