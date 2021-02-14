<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class UserAvatarController extends Controller {

    public function index($id, $size = null) {

        $user = User::where('id', $id)->firstOrFail();

        if ($user->avatar_path) {

            $fileExtension = pathinfo(Storage::disk(config('aether.avatar_disk'))->path($user->avatar_path),
                PATHINFO_EXTENSION);

            if (config('aether.use_fancy_avatar_paths')) {

                $allowedSizes = ['s', 'm', 'l', 'xl'];

                if (in_array($size, $allowedSizes)) {
                    if ($size) {
                        return response()->file(Storage::disk(config('aether.avatar_disk'))->path(('users/'.$user->id.'/'.$size.'_avatar.'.$fileExtension)));
                    }
                }
            }

            // if fancy avatars are enabled, lets return the largest one instead. :)

            if (config('aether.use_fancy_avatar_paths')) {
                return response()->file(Storage::disk(config('aether.avatar_disk'))->path(('users/'.$user->id.'/xl_avatar.'.$fileExtension)));
            }
            else {
                return response()->file(Storage::disk(config('aether.avatar_disk'))->path($user->avatar_path));
            }
        }
        return abort(404);
        //return '<img src="https://ui-avatars.com/api/'.urlencode($user->name).'/192/EBF4FF/7F9CF5" />';
    }
}