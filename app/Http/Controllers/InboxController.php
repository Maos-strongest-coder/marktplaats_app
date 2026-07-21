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
        $authId = Auth::id();

        $conversations = Message::whereIn('id', function ($query) use ($authId) {
            $query->select(DB::raw('MAX(id)'))
                ->from('messages')
                ->where('sender_id', $authId)
                ->orWhere('receiver_id', $authId)
                ->groupBy('advertisement_id',  DB::raw("CASE WHEN sender_id = $authId THEN receiver_id ELSE sender_id END"));
        })
            ->with(['sender', 'receiver', 'advertisement'])
            ->latest()
            ->get();
            
            
            

        $activeMessages = collect();

        if($request->has(['partner_id', 'advertisement_id'])) 
        {
            $activeMessages = Message::where('advertisement_id', $request->query('advertisement_id'))
                ->where(function ($query) use ($authId, $request) 
                {
                    $partnerId = $request->query('partner_id');

                    $query->where(function ($q) use ($authId, $partnerId) 
                    {
                        $q->where('sender_id', $authId)
                          ->where('receiver_id', $partnerId);

                    })->orWhere(function ($q) use ($authId, $partnerId) 
                    {
                        $q->where('sender_id', $partnerId)
                          ->where('receiver_id', $authId);
                    });
                })
                ->with(['sender', 'receiver', 'advertisement'])
                ->oldest()
                ->get();            
        }

        return view('messages.inbox', compact('conversations', 'activeMessages'));

    }

    

    
}
