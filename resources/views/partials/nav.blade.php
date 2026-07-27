<nav class="bg-gray-800">

    <div class="ml-10 flex items-baseline space-x-4">
        <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Home Page
        </a>
        
        @auth
        <a href="{{ route('advertisements.my') }}" class="{{ request()->routeIs('advertisements.my') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            My Advertisements
        </a>

        <a href="{{ route('advertisements.create') }}" class="{{ request()->routeIs('advertisements.create') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Create a new Advertisement
        </a>

        <a href="{{ route('inbox') }}" class="{{ request()->routeIs('inbox') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Inbox
        </a>
        
        <a href="{{ route('settings.show') }}" class="{{ request()->routeIs('settings.show') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Settings
        </a>
        @endauth

        @guest
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Log in
        </a> 

        <a href="{{ route('register.show') }}" class="{{ request()->routeIs('register') ? 'bg-black text-white' : 'text-white hover:bg-white/5 hover:text-blue-300' }} px-3 py-2 rounded-md text-sm font-medium">
            Create an Account
        </a>
        @endguest
    </div>

</nav>