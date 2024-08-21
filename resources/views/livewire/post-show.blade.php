<div>
    <div class="flex flex-col gap-3">
        <div class="text-2xl font-semibold">
            {{$post->title}}

        </div>

        <img src="{{ asset('storage/' . $post->image) }}" class="w-[600px]" alt="...">

        <div>{{$post->created_at}}</div>
        <div class="flex gap-1">
            @foreach ($post->categories as $category)
            <div class="bg-blue-200 px-1 text-sm rounded-md">
                {{$category->name}}
            </div>
            @endforeach

        </div>

        {!! $post->body !!}

        <div class="mt-5">
            <livewire:post-comment :post="$post">
        </div>
    </div>

</div>