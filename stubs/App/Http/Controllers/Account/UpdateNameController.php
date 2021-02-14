<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Auth;
use Hash;
use App\Models\User;

class UpdateNameController extends Controller {

    public function index() {

        if (config('aether.can_change_name')) {
            return view('account.name');
        }
        return abort(404);
    }

    public function store(Request $request) {

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->withErrors("You have entered an incorrect password. Please try again.");
        }

        $request->validate([
            'password' => ['required', 'password'],
            'name' => ['required', Rule::unique('users')->ignore(Auth::user()->id)]
        ]);

        User::where('id', '=', Auth::user()->id)->update([
            config('aether.name_column', 'name') => $request->input('name'),
        ]);


        return redirect()->back()->with('account-success', 'Your account has been updated successfully.');
    }

}