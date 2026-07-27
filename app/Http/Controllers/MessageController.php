<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\MessageReceived;
use App\Models\Message;
use App\Http\Requests\SendMessageRequest;

class MessageController extends Controller
{
    public function sendMessage(SendMessageRequest $request)
    {
        $outgoingValues = $request->validated();

        if (Auth::id() == $outgoingValues['receiver_id']) {
            return redirect()->back()->with('error', 'You cannot send a message to yourself');
        }

        $message = Message::create([
            'content' => $outgoingValues['content'],
            'receiver_id' => $outgoingValues['receiver_id'],
            'sender_id' => Auth::id(),
            'advertisement_id' => $outgoingValues['advertisement_id'],
        ]);

        $receiver = User::find($outgoingValues['receiver_id']);

        $receiver->notify(new MessageReceived($message));

        return redirect()->route('messages.inbox', [
            'partner_id' => $outgoingValues['receiver_id'],
            'advertisement_id' => $outgoingValues['advertisement_id']
        ])->with('message', 'Message sent successfully');
    }
}
