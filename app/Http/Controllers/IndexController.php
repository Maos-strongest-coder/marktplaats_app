<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Advertisement;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $query = Advertisement::query();

        $query->when($request->filled('search'), function ($query) use ($request) {
            $query->whereFullText(['title', 'content'], $request->input('search'));
        });

        $query->when($request->filled('category_id'), function ($query) use ($request) {
            $query->where('category_id', $request->input('category_id'));
        });

        $advertisements = $query->paginate(9)->withQueryString();
        

        return view('index', compact('categories', 'advertisements'));
    }
}

