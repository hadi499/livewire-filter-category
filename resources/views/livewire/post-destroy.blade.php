<div x-data="{ open: false }">
    <!-- <button class=" bg-red-400 hover:text-white px-3 py-1 rounded hover:bg-red-700" wire:click="destroy" wire:confirm="Are sure delete this post?">Delete</button> -->
    <!-- Trigger Button -->
    <button @click="open = true" class="px-3 py-1 bg-red-500 text-white rounded">
        Delete
    </button>

    <!-- Modal Background -->
    <div x-show="open" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <!-- Modal -->
        <div @click.away="open = false" class="bg-white p-6 flex flex-col items-center rounded shadow-lg max-w-sm w-full">

            <p class="mb-4 text-lg">Are sure delete item: <span class="text-xl font-semibold">{{$post->title}}</span> ?</p>
            <div class="flex gap-3">

                <button @click="open = false" class="px-3 py-1 bg-blue-500 text-white rounded">
                    Cancel
                </button>
                <button wire:click="destroy" class="px-3 py-1 bg-red-500 text-white rounded">
                    Delete
                </button>

            </div>
        </div>
    </div>
</div>