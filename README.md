# Aether - Account Scaffolding for Laravel Breeze

Aether adds user account page functionality for Laravel Breeze, Aether requires Laravel Breeze in order to work. The following pages are introduced by Aether:

- Account Home
- Update Avatar
- Update Name Form
- Update Password Form
- Update Email Form

![Aether Account Home](https://i.imgur.com/47Q7U4d.png)

![Aether Account Avatar](https://i.imgur.com/B1a8wdC.png)

![Aether Account Name](https://i.imgur.com/llC2GjA.png)


This works with Laravel Breeze version v1.0.2 at the very least, and should continue to work unless breaking changes are introduced in Laravel Breeze.

This package also borrows the banner component from Laravel Jetstream, as I liked it and wanted to include it within my Breeze projects.


## Installation Instructions

**Ensure that Laravel Breeze's scaffolding has been configured first.**

Require Aether from Composer.
```
composer require lewislarsen/aether
```
To setup Aether's pages on your brand new application.
```
php artisan aether:install
```
Add the HasAvatar trait to your User model.
```
use LewisLarsen\Aether\HasAvatar;

use HasFactory, Notifiable, HasAvatar;
```

## Aether's Configuration File

I have tried to make the scaffolding as adaptable as possible, below are an explanation of the config settings. 

```
    'name_column' => 'name',
    'email_column' => 'email',
```
By default, these two columns come with Laravel, however should you need to rename your columns, this config value will change what Aether looks for when updating user data.

```
    'avatar_column' => 'avatar_path',
```
This column is included in the migration and is used for linking the avatar to the user, however this can be changed if needed.

```
    'can_change_name' => true,
    'can_change_email' => true,
    'can_change_password' => true,
    'can_change_avatar' => true,
```
Should you wish to prevent users from changing certain settings, you can do so by changing the value to false. This will hide the sidebar item and 404 the route. By default, all of these are true.

```
'show_avatar_on_account_index' => true,
'show_avatar_on_navigation' => true,
```
These options will alter whether the avatar is visible from the account index page and the navigation blade template. By default these are set to be shown.

```
    'avatar_disk' => 'local',
```
Should you wish to alter the disk that Aether saves to, you can do it by changing this configuration value. By default Aether saves to the `local` disk as it gets the avatars from a special route. 

```
    'use_fancy_avatar_paths' => true,
```
When this option is set to true, all avatars that are uploaded after the setting being changed will generate four additional avatar sizes and allow for a size parameter to be specified on the avatar route. 

To specify a size, there is an optional parameter in an avatar method, found on the `HasAvatar` trait. 
An example is below.
```
{{ Auth::user()->avatar('s') }}
```
The parameter is optional and Aether will fall back to UI-Avatars should the user have no avatar set. 
```
    'sm_avatar_size' => '48',
    'md_avatar_size' => '96',
    'lg_avatar_size' => '192',
    'xl_avatar_size' => '384',
```
If the `use_fancy_avatar_paths` configuration value is set to true, this will determine the sizes of the avatars as four sizes will be made alongside the original file being uploaded. Please note that any changes to these values will not affect already uploaded avatars, only ones that are uploaded after the values have been modified.

## Aether's Avatar Route

Aether has an avatar route which can be found at the `avatars` subdomain. An example of the route is below.
```
avatars.domain.com/u/{id}/{?size}
avatars.domain.com/u/1/
avatars.domain.com/u/1/s
avatars.domain.com/u/1/m
avatars.domain.com/u/1/l
avatars.domain.com/u/1/xl
```
Should the user have no avatar, the trait will fall back to UI Avatars, in which case the avatars route will return a 404 as it's only used for uploaded user content. 

## Aether Account Flash Messages
Aether comes with a flash message component for the account pages. 
```
$request->session()->flash('account-success', 'Success message!');
$request->session()->flash('account-error', 'Error message!');
$request->session()->flash('account-warning', 'Warning message!');
$request->session()->flash('account-info', 'Info message!');
```

## Application-wide Banner Messages
The banner message component for this came from [Laravel Jetstream](https://jetstream.laravel.com/2.x/building-your-app.html#banner-alerts).
```
$request->session()->flash('flash.banner', 'Yay it works!');
$request->session()->flash('flash.bannerStyle', 'success');

```
