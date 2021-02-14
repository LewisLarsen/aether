<?php


namespace LewisLarsen\Aether;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Route;

trait HasAvatar {
    /**
     * Update the user's avatar.
     *
     * @param  \Illuminate\Http\UploadedFile  $avatar
     * @return void
     */
    public function updateAvatar(UploadedFile $avatar) {
        tap($this->avatar_path, function ($previous) use ($avatar) {
            if (config('aether.use_fancy_avatar_paths')) {

                $custom = 'avatar.'.$avatar->getClientOriginalExtension();
                $avatar->storeAs('/users/'.$this->id.'/', $custom, $this->avatarDisk());

                $xl = Image::make($avatar)->fit(config('aether.xl_avatar_size', '384'),
                    config('aether.xl_avatar_size', '384'))->encode();
                $lg = Image::make($avatar)->fit(config('aether.lg_avatar_size', '384'),
                    config('aether.lg_avatar_size', '192'))->encode();
                $md = Image::make($avatar)->fit(config('aether.md_avatar_size', '384'),
                    config('aether.md_avatar_size', '96'))->encode();
                $sm = Image::make($avatar)->fit(config('aether.sm_avatar_size', '384'),
                    config('aether.sm_avatar_size', '48'))->encode();

                Storage::disk($this->avatarDisk())->put('users/'.$this->id.'/xl_avatar.'.$avatar->getClientOriginalExtension(),
                    $xl);
                Storage::disk($this->avatarDisk())->put('users/'.$this->id.'/l_avatar.'.$avatar->getClientOriginalExtension(),
                    $lg);
                Storage::disk($this->avatarDisk())->put('users/'.$this->id.'/m_avatar.'.$avatar->getClientOriginalExtension(),
                    $md);
                Storage::disk($this->avatarDisk())->put('users/'.$this->id.'/s_avatar.'.$avatar->getClientOriginalExtension(),
                    $sm);

                $this->forceFill([
                    'avatar_path' => '/users/'.$this->id.'/avatar.'.$avatar->getClientOriginalExtension(),
                ])->save();
            }
            else {
                $this->forceFill([
                    'avatar_path' => $avatar->storePublicly('avatars', ['disk' => $this->avatarDisk()]),
                ])->save();

                if ($previous) {
                    Storage::disk($this->avatarDisk())->delete($previous);
                }
            }
        });
    }

    /**
     * Delete the user's avatar.
     *
     * @return void
     */
    public function deleteAvatar() {
        Storage::disk($this->avatarDisk())->delete($this->avatar_path);

        if (config('aether.use_fancy_avatar_paths')) {

            Storage::disk($this->avatarDisk())->deleteDirectory('users/'.$this->id);
        }

        $this->forceFill([
            'avatar_path' => null,
        ])->save();
    }


    public function avatar($s = null) {
        return $this->avatar_path ? route('user-avatar', ['id' => $this->id, 'size' => $s]) : $this->defaultAvatarUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultAvatarUrl()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }


    /**
     * Get the disk that avatars should be stored on.
     *
     * @return string
     */
    protected function avatarDisk() {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('aether.avatar_disk', 'local');
    }
}