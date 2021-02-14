<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;

class UpdatePasswordController extends Controller {

    public function index() {

        if (config('aether.can_change_password')) {
            return view('account.password');
        }
        return abort(404);
    }

    public function store(Request $request) {

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->withErrors("You have entered an incorrect password. Please try again.");
        }

        if (strcmp($request->get('password'), $request->get('new_password')) == 0) {
            return redirect()->back()->withErrors("Your new password cannot be the same as your current password, please choose an alternative password instead.");
        }

        $request->validate([
            'password' => ['required', 'password'],
            'new_password' => ['required', 'min:6', 'confirmed', 'string'],
        ]);

        User::where('id', '=', Auth::user()->id)->update([
            'password' => bcrypt($request->get('new_password')),
        ]);

        return redirect()->back()->with('account-success', 'Your account has been updated successfully.');
    }
}