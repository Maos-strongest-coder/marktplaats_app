@extends('layouts.app')

@section('title', 'Create Advertisement')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
        <div class="mb-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Create new Advertisement</h2>
        </div>

        <form method="POST" action="{{ route('advertisements.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="border p-2 " required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Image Path</label>
                <input type="text" name="image_path" value="{{ old('image_path') }}" class="border p-2 " required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="content" rows="8" class="border p-2" required>{{ old('content') }}</textarea>
            </div>


            <div class="mb-4">
                <label class="block font-medium">Select a Category</label>
                <select name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <div class="mb-4 font-medium">
                <label class="block font-medium">price</label>
                $<input type="number" name="price" value="{{ old('price') }}" min="0" max="9001" step=".01" class="border p-2 " required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Pay ten dorra to promote your advertisment!</label>
                <input type="checkbox" name="is_promoted" value="1" {{ old('promote')  ? 'checked' : '' }}>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2">Publish Advertisement</button>
        </form>
    </div>
@endsection
