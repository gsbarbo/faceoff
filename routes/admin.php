<?php

use App\Http\Controllers\Admin\DashboardPageController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Middleware\AccessMiddleware;
use App\Services\Discord\DiscordNotificationService;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardPageController::class)->name('dashboard')->middleware(AccessMiddleware::class.':admin.teams.*');
Route::resource('/teams', TeamController::class)->middleware(AccessMiddleware::class.':admin.teams.*');

Route::get('/test', function () {
    try {
        DiscordNotificationService::make()
//            ->channel(1442184444957032558)
            ->content('Test message')
            ->send();
    } catch (Exception $e) {
        return $e->getMessage();
    }

    return true;
});
