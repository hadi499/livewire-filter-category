<div>

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
            @foreach ($posts as $post)
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
                        <a wire:navigate href="{{ route('dashboard.edit', $post->slug) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                        <livewire:post-destroy :post="$post" wire:key="post-destroy-{{ $post->id }}" />

                    </div>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <div class="my-3">



    </div>


</div>