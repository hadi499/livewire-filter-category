<div>

    <div class="mt-2">
        @foreach($categories as $category)
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
    </div>
</div>