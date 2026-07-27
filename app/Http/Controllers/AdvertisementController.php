<?php

namespace App\Http\Controllers;


use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;


 

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

    public function store(StoreAdvertisementRequest $request)
    {
        $validated = $request->validated();

        /** @var \App\Models\User $user  */
        $user = Auth::user();

        $user->advertisements()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $validated['image_path'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'is_promoted' => $request->input('is_promoted', false),
            'is_active' => $request->input('is_active', true),
            'promoted_at' => $request->has('promote') ? now() : null,
        ]);
        
        return redirect()->route('advertisements.my')->with('message', 'Advertisement created Successfully');
    }

    public function edit(Advertisement $advertisement)
    {
        $categories = Category::all();
        return view('advertisements.edit', compact('advertisement', 'categories'));
    }

    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        $validated = $request->validated();

        $advertisement->update($validated);
        
        return redirect()->route('advertisements.my')->with('message', 'Advertisement updated successfully!');
    }

    public function destroy(Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id) {
            return redirect()->route('advertisements.my')->withErrors(['error' => 'You are not authorized to delete this advertisement.']);
        }

        $advertisement->delete();

        return redirect()->route('advertisements.my')->with('message', 'Advertisement deleted successfuly');
    }

    public function promoteForm(Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id) {
            return redirect()->back()->withErrors(['error' => "You cannot promote someone else's advertisement"]);
        }

        return view('advertisements.promote', ['advertisement' => $advertisement]);
    }

    public function promote(Advertisement $advertisement)
    {
        if (Auth::id() !== $advertisement->user_id) {
            return redirect()->back()->withErrors(['error' => "You cannot promote someone else's advertisement"]);
        }

        $advertisement->update([
            'is_promoted' => true,
            'promoted_at' => now(),
        ]);

        return redirect()->route('advertisements.my')->with('message', 'Advertisement promoted successfuly');
    }

}

