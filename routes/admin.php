<?php

use App\Http\Controllers\Admin\DashboardPageController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardPageController::class)->name('dashboard');
Route::resource('/team', TeamController::class);

Route::get('/test', function () {
    $user = auth()->user();
    auth()->user()->assignRole('Admin');

    //    dd(auth()->user()->getAllPermissions()->toArray());

});
