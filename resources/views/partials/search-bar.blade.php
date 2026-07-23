<div>
    <form action="{{ route('dashboard.index') }}" method="GET" class="bg-white p-4 rounded-lg border border-gray-100">

        <label for="category_id"></label>
        <select name="category_id" class="border border-gray-300 rounded-md px-2 py-1">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        <label for="keyword"></label>
        <input id="keyword" type="text" name="search" value="{{ request('search') }}" placeholder="Search for anything...">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>

        @if(request()->anyFilled(['search', 'category_id']))
        <a href="{{ route('dashboard.index') }}" class="bg-red-500 text-white px-4 py-2 rounded">Clear Filters</a>
        @endif
    </form>
</div>