<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use LewisLarsen\Aether\Notifications\PasswordWasChangedNotification;

class UpdatePasswordController extends Controller
{
    public function index()
    {
        if (config('aether.can_change_password')) {
            return view('account.password');
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->withErrors('You have entered an incorrect password. Please try again.');
        }

        if (strcmp($request->get('password'), $request->get('new_password')) == 0) {
            return redirect()->back()->withErrors('Your new password cannot be the same as your current password, please choose an alternative password instead.');
        }

        $request->validate([
            'password'     => ['required', 'password'],
            'new_password' => ['required', 'min:6', 'confirmed', 'string'],
        ]);

        $user = User::where('id', '=', Auth::user()->id)->update([
            'password' => bcrypt($request->get('new_password')),
        ]);

        Auth::user()->notify(new PasswordWasChangedNotification(Auth::user()));

        return redirect()->back()->with('account-success', 'Your account has been updated successfully.');
    }
}
