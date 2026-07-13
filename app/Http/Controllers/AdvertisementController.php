<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function show($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('advertisements.show', compact('advertisement'));
    }

    public function myAdvertisements()
    {
        $user = Auth::user();
        $advertisements = Advertisement::where('user_id', $user->id)->orderBy('created_at', 'desc')->orderBy('title', 'asc')->paginate(9);

        return view('advertisements.my', compact('advertisements'));
    }
}
