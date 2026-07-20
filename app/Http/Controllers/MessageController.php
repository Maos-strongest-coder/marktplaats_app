<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\MessageReceived;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $outgoingValues = $request->validate([
            'content' => ['required', 'min:2', 'max:510'],
            'receiver_id' => ['required', 'exists:users,id'],
            'advertisement_id' => ['required', 'exists:advertisements,id']
            
        ]);

        if (Auth::id() === $outgoingValues['receiver_id']) {
            return redirect()->back()->with('error', 'You cannot send a message to yourself');
        }

        $message = Auth::user()->sent()->create([
            'content' => $outgoingValues['content'],
            'receiver_id' => $outgoingValues['receiver_id'],
            'advertisement_id' => $outgoingValues['advertisement_id'],
        ]);

        $receiver = User::find($outgoingValues['receiver_id']);

        $receiver->notify(new MessageReceived($message));



        Auth::user()->sent()->create([
            'content' => $outgoingValues['content'],
            'receiver_id' => $outgoingValues['receiver_id'],
            'advertisement_id' => $outgoingValues['advertisement_id'],
        ]);

        return redirect()->route('inbox', [
            'partner_id' => $outgoingValues['receiver_id'],
            'advertisement_id' => $outgoingValues['advertisement_id']
        ])->with('message', 'Message sent successfully');
    }
}
