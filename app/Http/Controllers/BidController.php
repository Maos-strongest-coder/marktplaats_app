<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBidRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Advertisement;
use App\Models\Bid;

class BidController extends Controller
{
    public function store(StoreBidRequest $request, Advertisement $advertisement)
    {
        $validated = $request->validated();

        if ($advertisement->user_id === Auth::id()) {
            return redirect()->back()->withErrors(['amount' => 'you cannot make a bid on your own advertisement']);
        }

        Bid::create([
            'advertisement_id' => $advertisement->id,
            'user_id' => Auth::id(),
            'amount' => $validated['amount']
        ]);

        return redirect()->back()->with('message', 'Bid made successfully');
    }
}
