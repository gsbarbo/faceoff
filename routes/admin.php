<?php

use App\Http\Controllers\Admin\DashboardPageController;
use App\Http\Controllers\Admin\Games\EventController;
use App\Http\Controllers\Admin\Games\GameController;
use App\Http\Controllers\Admin\Games\SeasonController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Middleware\AccessMiddleware;
use App\Services\Discord\DiscordNotificationService;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardPageController::class)->name('dashboard')->middleware(AccessMiddleware::class.':admin.*');

Route::resource('season-and-events/games', GameController::class)->middleware(AccessMiddleware::class.':admin.games.*')->except('show', 'destroy');
Route::resource('season-and-events/seasons', SeasonController::class)->middleware(AccessMiddleware::class.':admin.seasons.*')->except('show', 'destroy');
Route::resource('season-and-events/events', EventController::class)->middleware(AccessMiddleware::class.':admin.events.*')->except('show', 'destroy');

Route::resource('/teams', TeamController::class)->middleware(AccessMiddleware::class.':admin.teams.*')->except('show', 'destroy');

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
