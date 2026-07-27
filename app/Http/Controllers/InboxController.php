<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Illuminate\Support\Facades\DB;



class InboxController extends Controller
{
    public function inbox(Request $request)
    {
        $UserId = Auth::id();

        $conversations = Message::whereIn('id', function ($query) use ($UserId) {
            $query->select(DB::raw('MAX(id)'))
                ->from('messages')
                ->where('sender_id', $UserId)
                ->orWhere('receiver_id', $UserId)
                ->groupBy('advertisement_id',  DB::raw("CASE WHEN sender_id = $UserId THEN receiver_id ELSE sender_id END"));
        })
            ->with(['sender', 'receiver', 'advertisement'])
            ->latest()
            ->get();
            
        $activeMessages = collect();

        if($request->has(['partner_id', 'advertisement_id'])) 
        {
            $activeMessages = Message::where('advertisement_id', $request->query('advertisement_id'))
                ->where(function ($query) use ($UserId, $request) 
                {
                    $partnerId = $request->query('partner_id');

                    $query->where(function ($q) use ($UserId, $partnerId) 
                    {
                        $q->where('sender_id', $UserId)
                          ->where('receiver_id', $partnerId);

                    })->orWhere(function ($q) use ($UserId, $partnerId) 
                    {
                        $q->where('sender_id', $partnerId)
                          ->where('receiver_id', $UserId);
                    });
                })
                ->with(['sender', 'receiver', 'advertisement'])
                ->oldest()
                ->get();            
        }

        return view('messages.inbox', compact('conversations', 'activeMessages'));

    }

    

    
}
