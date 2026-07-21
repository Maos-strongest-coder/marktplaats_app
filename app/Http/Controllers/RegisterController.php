<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request) {
        $incomingValues = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name' => $incomingValues['name'],
            'email' => $incomingValues['email'],
            'password' => Hash::make($incomingValues['password']),
            'notifications_enabled' => $request->has('notifications_enabled')
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect('/email/verify');
    }
}
