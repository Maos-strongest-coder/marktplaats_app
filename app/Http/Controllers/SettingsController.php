<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function showSettings()
    {
        return view('profile.settings', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        User::where('id', Auth::id())->update([
            'notifications_enabled' => $request->has('notifications_enabled')
        ]);

        return redirect()->back()->with('message', 'Setings changed succesfully');
    }
}
