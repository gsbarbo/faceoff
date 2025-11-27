<?php

use App\Http\Controllers\Admin\DashboardPageController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Middleware\AccessMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardPageController::class)->name('dashboard')->middleware(AccessMiddleware::class.':admin.teams.*');
Route::resource('/teams', TeamController::class)->middleware(AccessMiddleware::class.':admin.teams.*');
