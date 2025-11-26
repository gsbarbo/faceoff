<?php

use App\Http\Controllers\Auth\DiscordLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    require __DIR__.'/admin.php';
});
