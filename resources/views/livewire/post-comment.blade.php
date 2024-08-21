<div class="px-3 w-1/2">
    <div>
        <h5 class="mb-3 ml-2">{{$total_comment}} Comments</h5>
    </div>
    <div class="mb-4 p-3 border rounded-lg shadow-sm">
        @auth
        <form wire:submit.prevent="store" class="px-2">
            <div class="mb-3">
                <textarea wire:model.defer="body" rows="2"
                    class="w-full p-2 border rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Tulis komentar..."></textarea>
                @error('body')
                <div class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Submit</button>
            </div>
        </form>
        @else
        <div class="px-2" wire:click="redirectToLogin">
            <div class="mb-3">
                <textarea wire:model.defer="body" rows="2"
                    class="w-full p-2 border rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Tulis komentar..."></textarea>
                @error('body')
                <div class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg">Submit</button>
            </div>
        </div>

        @endauth

    </div>

    @foreach ($comments as $comment)
    <div class="mb-3 w-full" wire:key="{{$comment->id}}">
        <div class="flex items-start">
            <img class="rounded-full mr-2" width="40"
                src="https://cdn.cloudflare.steamstatic.com/steamcommunity/public/images/avatars/91/91a09746173fa3251cd6c1cce849d77d8444f816_full.jpg"
                alt="">
            <div>
                <div>
                    <span>{{$comment->user->name}}</span>
                    <span>{{$comment->created_at}}</span>
                </div>
                <div class="mb-2 text-gray-600">
                    {{$comment->body}}
                </div>


            </div>
        </div>
    </div>


    @endforeach

</div>