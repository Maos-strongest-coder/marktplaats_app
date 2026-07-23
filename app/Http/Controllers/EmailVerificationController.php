<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
     
    public function notice() 
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request) 
    {
        $request->fulfill();

        return redirect('/advertisements/my')
            ->with('message', 'Your email has successfully been verified!');
    }

    public function send(Request $request) 
    {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('status', 'verification-link-sent');
    }
}
