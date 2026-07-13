<form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="border p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2">Log in</button>
    </form>