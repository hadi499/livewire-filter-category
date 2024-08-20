<nav class="bg-white shadow-md">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <a wire:navigate href="/" class="text-xl font-semibold text-gray-800 hover:text-blue-700">MyBlog</a>
        </div>
        <!-- Navigation Links -->

      </div>
      <!-- Right Side -->
      <div class="flex items-center space-x-4">
        @auth

        <a wire:navigate href="{{ route('dashboard') }}" class="text-gray-500 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" x-data>
          @csrf

          <a href="{{ route('logout') }}" class="text-gray-500 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium"
            @click.prevent="$root.submit();">
            Logout
          </a>
        </form>
        @else
        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
        <a href="{{ route('register') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
        @endauth
      </div>
    </div>
  </div>
</nav>