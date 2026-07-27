<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\SendResetLinkRequest;
use App\Http\Requests\ResetPasswordRequest;


class PasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }
    
    public function sendResetLink(SendResetLinkRequest $request) 
    {
        $request->validated();

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function showResetForm(Request $request, string $token) 
    {
        return view('auth.reset-password', ['token' => $token, 'request' => $request]);
    }

    public function reset(ResetPasswordRequest $request) 
    {
        $request->validated();
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
