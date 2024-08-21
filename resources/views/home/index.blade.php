<x-guest-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="topics flex flex-wrap justify-start gap-2 mb-3">
        @foreach ($categories as $category)
        <a wire:navigate href="{{ route('home', ['category' => $category->slug]) }}" class="bg-blue-200 p-1">
          {{ $category->name }}
        </a>
        @endforeach
      </div>
      <livewire:home-list />
    </div>
  </div>
</x-guest-layout>