@extends('layouts.app')

@section('title', 'Edit Advertisement')

@section('content')
<div class="flex h-[80vh] bg-white border rounded-lg overflow-hidden max-w-6xl mx-auto my-6">    
    <div class="w-1/3 border-r bg-gray-50 overflow-y-auto">
        <div class="p-4 font-bold border-b bg-gray-100">Edit Advertisement</div>

        <div class="container mx-auto px-4 py-8 max-w-2xl flex flex-col items-center justify-center">
                    

            <form method="POST" action="{{ route('advertisements.update', $advertisement->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title', $advertisement->title) }}" class="border p-2 " required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Image Path</label>
                    <input type="text" name="image_path" value="{{ old('image_path', $advertisement->image_path) }}" class="border p-2 " required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Description</label>
                    <textarea name="content" rows="8" class="border p-2" required>{{ old('content', $advertisement->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Select a Category</label>
                    <select name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $advertisement->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                

                <div class="mb-4 font-medium">
                    <label class="block font-medium">price</label>
                    $<input type="number" name="price" value="{{ old('price', $advertisement->price) }}" min="0" max="9001" step=".01" class="border p-2 " required>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2">Edit Advertisement</button>
            </form>
            </div>
    </div>
    <div class="w-full border-l h-full relative overflow-y-auto bg-white flex flex-col justify-between">
        <div class="p-4 border-b bg-gray-50 shrink-0">
            <h2 class="font-bold text-lg text-gray-900">{{ $advertisement->title }}</h2>
            <h3 class="text-xs text-gray-500">Original Advertisement</h3>
        </div>

        <div class="m-auto text-center text-gray-400 p-6">
            @include('partials.advertisement-card')
        </div>
    </div>

    
    
</div>
@endsection
