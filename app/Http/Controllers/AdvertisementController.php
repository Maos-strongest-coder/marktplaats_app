<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function show($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('advertisements.show', compact('advertisement'));
    }
}
