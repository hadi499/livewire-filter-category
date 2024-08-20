<div>
    <form wire:submit.prevent="update" class="flex flex-col gap-2 border p-4 shadow-lg bg-slate-100">
        <div class="flex flex-col gap-1">
            <label for="title">Title</label>
            <input type="text" id="title" wire:model="title" class="rounded-md">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="slug">Slug</label>
            <input type="text" id="slug" disabled wire:model="slug" class="rounded-md">
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="image" class="form-label">Image</label>
            @if($existingImage)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $existingImage) }}" alt="Current Image" class="rounded-md w-32 h-32 object-cover">
            </div>
            @endif
            <input type="file" id="image" wire:model="image">
        </div>

        <div class="flex flex-col gap-1">
            <label for="categories">Categories:</label>
            @foreach ($categories as $category)
            <div>
                <label>
                    <input
                        type="checkbox"
                        wire:model="selectedCategories"
                        value="{{ $category->id }}" />
                    {{ $category->name }}
                </label>
            </div>
            @endforeach
            @error('selectedCategories') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="flex flex-col gap-1">
            <label for="body">Body</label>
            <input id="body" type="hidden" name="body" wire:init="body" value="{{$this->body}}">
            <trix-editor input="body" class="bg-white rounded-md"></trix-editor>
            @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="ml-auto mt-3">
            <button wire:click="cancel" class="py-1 px-3 mr-3 bg-red-300 rounded-md hover:bg-red-800 hover:text-white">
                Cancel
            </button>
            <button type="submit" class="py-1 px-3 bg-blue-300 rounded-md hover:bg-blue-800 hover:text-white">
                Update
            </button>
        </div>
    </form>
</div>

@script
<script>
    let trixEditor = document.getElementById("body")
    addEventListener("trix-blur", function(event) {
        @this.set('body', trixEditor.getAttribute('value'))
    })
</script>
@endscript