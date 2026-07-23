<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

 

class AdvertisementController extends Controller
{
    public function show(Advertisement $advertisement)
    {
        return view('advertisements.show', compact('advertisement'));
    }

    public function myAdvertisements()
    {
        
        $user = Auth::user();
        $advertisements = Advertisement::where('user_id', $user->id)->latest()->paginate(9);

        return view('advertisements.my', compact('advertisements'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('advertisements.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'image_path' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $user->advertisements()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $validated['image_path'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'is_paid' => $request->input('is_paid', false),
            'is_active' => $request->input('is_active', true),
        ]);

        return redirect()->route('advertisements.my')->with('message', 'Advertisement created Successfully');
    }

    public function edit(Advertisement $advertisement)
    {
        $categories = Category::all();
        return view('advertisements.edit', compact('advertisement', 'categories'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string|min:10',
        'image_path' => 'nullable|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0|max:9001',
    ]);

        $advertisement->update($validated);
        
        return redirect()->route('advertisements.my')->with('message', 'Advertisement updated successfully!');
}
    }

