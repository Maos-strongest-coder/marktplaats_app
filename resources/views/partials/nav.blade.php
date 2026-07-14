<nav class="bg-gray-800">

    <div class="ml-10 flex items-baseline space-x-4">

        <a href="{{ route('index') }}" class="<?php if ($_SERVER['REQUEST_URI'] === '/') echo 'bg-black text-white hover:text-blue-300';
                                                        else echo 'text-white hover:bg-white/5 hover:text-blue-300'; ?>">Home Page</a>
        @auth
        <a href="{{ route('advertisements.my') }}" class="<?php if ($_SERVER['REQUEST_URI'] === '/advertisements/my') echo 'bg-black text-white hover:text-blue-300';
                                                        else echo 'text-white hover:bg-white/5 hover:text-blue-300'; ?>">My Advertisements</a>
        @endauth
        @guest
        <a href="{{ route('login') }}" class="<?php if ($_SERVER['REQUEST_URI'] === '/login') echo 'bg-black text-white hover:text-blue-300';
                                                        else echo 'text-white hover:bg-white/5 hover:text-blue-300'; ?>">Log in</a>

        <a href="{{ route('register') }}" class="<?php if ($_SERVER['REQUEST_URI'] === '/register') echo 'bg-black text-white hover:text-blue-300';
                                                        else echo 'text-white hover:bg-white/5 hover:text-blue-300'; ?>">Create an Account</a>
        @endguest
    </div>

</nav>