<div>
    <div class="topics flex flex-wrap justify-start gap-2 mb-3">

        @foreach ($categories as $category)
        <a wire:navigate href="{{ route('dashboard', ['category' => $category->slug]) }}" class="bg-blue-200 p-1">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
    <div class="mb-4">
        <livewire:search-box />
    </div>

    <div class="text-gray-600 my-3">
        @if ($this->activeCategory || $search)
        <button class="mr-3 text-xs gray-500" wire:click="clearFilters()">X</button>
        @endif
        @if ($this->activeCategory)
        <a wire:navigate href="{{ route('dashboard', ['category' => $this->activeCategory->slug]) }}">
            {{ $this->activeCategory->name }}
        </a>
        @endif
        @if ($search)
        <span class="ml-2">
            {{ __('blog.containing') }} : <strong>{{ $search }}</strong>
        </span>
        @endif
    </div>

    <div class="mb-6 flex justify-end">
        <a href="/dashboard/create" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-800 text-white">Create</a>
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-blue-50 ">
            <tr>
                <th class="px-4 py-2 border">Title</th>
                <th class="px-4 py-2 border">Image</th>
                <th class="px-4 py-2 border">Slug</th>
                <th class="px-4 py-2 border">Excerpt</th>
                <th class="px-4 py-2 border">Category</th>
                <th class="px-4 py-2 border">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($this->posts as $post)
            <tr class="bg-slate-50" wire:key="post-{{ $post->id }}">
                <td class="px-4 py-2 border">{{$post->title}}</td>
                <td class="px-4 py-2 border ">
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-10" alt="...">
                </td>
                <td class="px-4 py-2 border">{{$post->slug}}</td>
                <td class="px-4 py-2 border">{!! $post->getExcerpt() !!}</td>
                <td class="px-4 py-2 border ">
                    @foreach ($post->categories as $category)
                    <span class="bg-blue-200 ml-2 rounded-sm p-1 text-sm">
                        {{$category->name}}

                    </span>
                    @endforeach
                </td>
                <td class="px-4 py-2 border">
                    <div class="flex flex-row divide-y items-center gap-3 divide-gray-200">
                        <a wire:navigate href="{{ route('dashboard.edit', $post->slug) }}" class="bg-blue-300 hover:text-white px-3 py-1 rounded hover:bg-blue-700">Edit</a>
                        <a wire:navigate href="{{ route('dashboard.show', $post->slug) }}" class="bg-green-300 hover:text-white px-3 py-1 rounded hover:bg-green-700">Detail</a>
                        <livewire:post-destroy :post="$post" wire:key="post-destroy-{{ $post->id }}" />

                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="my-3">
        {{$this->posts->links()}}
    </div>


</div>