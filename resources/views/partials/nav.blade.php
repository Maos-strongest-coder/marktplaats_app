<nav class="bg-gray-800">

    <div class="ml-10 flex items-baseline space-x-4">

        <a href="{{ route('index') }}" class="<?php if ($_SERVER['REQUEST_URI'] === '/') echo 'bg-black text-white hover:text-blue-300';
                                                        else echo 'text-white hover:bg-white/5 hover:text-blue-300'; ?>">Home Page</a>
        
    </div>

</nav>