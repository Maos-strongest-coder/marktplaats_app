<header class="relative bg-white shadow-sm">


  <h1 class="text-3xl font-bold tracking-tight text-gray-900">
    @auth
    Welcome, {{ auth()->user()->name }}!
    @else
    Welcome, Guest!
    @endauth
  </h1>

  @auth
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-red-600 text-white px-4 py-2">Log out</button>
  </form>
  @endauth
</header>