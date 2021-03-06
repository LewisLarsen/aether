<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateEmailController extends Controller
{
    public function index()
    {
        if (config('aether.can_change_email')) {
            return view('account.email');
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->withErrors('You have entered an incorrect password. Please try again.');
        }

        $request->validate([
            'password'  => ['required', 'password'],
            'email'     => ['required', 'password', Rule::unique('users')->ignore(Auth::user()->id)],
            'new_email' => ['required', 'min:6', 'confirmed', 'string'],
        ]);

        User::where('id', '=', Auth::user()->id)->update([
            config('aether.email_column', 'email') => $request->input('email'),
        ]);

        return redirect()->back()->with('account-success', 'Your account has been updated successfully.');
    }
}
