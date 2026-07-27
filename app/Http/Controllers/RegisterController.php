<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreRegistrationRequest;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(StoreRegistrationRequest $request) {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'notifications_enabled' => $request->has('notifications_enabled')
        ]);

        event(new Registered($user));
        Auth::login($user);
        
        return redirect('/email/verify');
    }
}
