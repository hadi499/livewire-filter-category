<div>

    <form wire:submit.prevent="store" class="flex flex-col gap-2 border p-4 shadow-lg bg-slate-100">
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
            <!-- <label for="slug">Slug</label>
            <input type="text" id="slug" wire:model="slug" class="rounded-md"> -->
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="flex flex-col gap-1">
            <label for="image" class="form-label">Image</label>
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
            <label for="body" class="">Body</label>
            <input id="body" type="hidden" name="body" wire:init="body" value="{{$this->body}}">
            <trix-editor input="body" class="bg-white rounded-md"></trix-editor>
            @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="ml-auto mt-3">
            <button type="submit" class="py-1 px-3 bg-blue-300 rounded-md hover:bg-blue-800 hover:text-white">Create</button>

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