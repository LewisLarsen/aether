<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class UpdateAvatarController extends Controller
{
    public function index()
    {
        if (config('aether.can_change_avatar')) {
            return view('account.avatar');
        }

        return abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'max:2500', 'mimes:jpeg,png,jpg'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                Auth::user()->updateAvatar($request->file('avatar'));
            }
        }

        return redirect()->back()->with('account-success', 'Your account has been updated successfully.');
    }

    public function delete()
    {
        Auth::user()->deleteAvatar();

        return redirect()->back()->with('account-success', 'Your avatar has been removed successfully.');
    }
}
