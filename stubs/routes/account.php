<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/account', 'account.index')->middleware('auth')->name('account');

Route::get(
    '/account/name',
    [\App\Http\Controllers\Account\UpdateNameController::class, 'index']
)->middleware('auth')->name('account.name');

Route::post('/account/name', [\App\Http\Controllers\Account\UpdateNameController::class, 'store'])->middleware('auth');

Route::get('/account/email', [
    \App\Http\Controllers\Account\UpdateEmailController::class,
    'index',
])->middleware('auth')->name('account.email');

Route::post(
    '/account/email',
    [\App\Http\Controllers\Account\UpdateEmailController::class, 'store']
)->middleware('auth');

Route::get('/account/password', [
    \App\Http\Controllers\Account\UpdatePasswordController::class,
    'index',
])->middleware('auth')->name('account.password');

Route::post(
    '/account/password',
    [\App\Http\Controllers\Account\UpdatePasswordController::class, 'store']
)->middleware('auth');

Route::get('/account/avatar', [
    \App\Http\Controllers\Account\UpdateAvatarController::class,
    'index',
])->middleware('auth')->name('account.avatar');

Route::get('/account/avatar/remove', [
    \App\Http\Controllers\Account\UpdateAvatarController::class,
    'delete',
])->middleware('auth')->name('account.remove-avatar');

Route::post(
    '/account/avatar',
    [\App\Http\Controllers\Account\UpdateAvatarController::class, 'store']
)->middleware('auth');

Route::domain('avatars.'.config('app.url'))->group(function () {
    Route::get('/u/{id}/{size?}/', [\App\Http\Controllers\Account\UserAvatarController::class, 'index'])->name('user-avatar');
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('account-success', 'Your verification email has been sent to '.Auth::user()->email.'.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
