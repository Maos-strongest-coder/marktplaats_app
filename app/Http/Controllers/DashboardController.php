<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Advertisement;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $query = Advertisement::query()->where('is_active', true)->orderBy('created_at', 'desc');

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->whereFullText(['title', 'content'], $request->input('search'));
        });

        $query->when($request->filled('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->input('category_id'));
        });



        $advertisements = $query->paginate(9)->withQueryString();
        

        return view('dashboard', compact('categories', 'advertisements'));
    }
}

