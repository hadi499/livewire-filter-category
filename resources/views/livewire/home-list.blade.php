<div>
    <div class="mb-4">
        <livewire:search-box />
    </div>

    <div class="text-gray-600 my-3">
        @if ($this->activeCategory || $search)
        <button class="mr-3 text-xs gray-500" wire:click="clearFilters()">X</button>
        @endif
        @if ($this->activeCategory)
        <a wire:navigate href="{{ route('home', ['category' => $this->activeCategory->slug]) }}">
            {{ $this->activeCategory->name }}
        </a>
        @endif
        @if ($search)
        <span class="ml-2">
            {{ __('blog.containing') }} : <strong>{{ $search }}</strong>
        </span>
        @endif
    </div>
    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($this->posts as $post)
        <div class="bg-white overflow-hidden border shadow-md rounded-lg p-4">

            <a wire:navigate href="{{ route('show', $post->slug) }}">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded-md mb-4" alt="{{ $post->title }}">

            </a>
            <h2 class="text-xl font-semibold ">{{ $post->title }}</h2>
            <p>{!! $post->getExcerpt() !!}</p>
            <div>

                @foreach ($post->categories as $category)
                <span class="bg-blue-200 mr-1 rounded-sm p-1 text-sm">
                    {{$category->name}}

                </span>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <div class="my-3">

        {{$this->posts->links()}}

    </div>

</div>