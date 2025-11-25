<?php

use App\Http\Controllers\Auth\DiscordLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/teams', function () {
    return view('teams');
})->name('teams');


Route::get('login', function () {
    return Socialite::driver('discord')->redirect();
})->name('login.discord')->middleware('guest');

Route::get('login/discord/handle', DiscordLoginController::class)->middleware('guest');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
