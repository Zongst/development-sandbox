<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Use App\Http\Controllers\Spotify\SpotifyDashboardController;
Use App\Http\Controllers\Spotify\SpotifyAuthController;
Use \App\Http\Controllers\Spotify\SpotifyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::prefix('/spotify')->name('spotify.')->group(function() {
    Route::get('/{offset?}', [SpotifyDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/playlists/all', [SpotifyController::class, 'get_all'])->name('get_all');
    Route::prefix('/auth')->name('auth.')->group(function() {
        Route::get('/redirect', [SpotifyAuthController::class, 'redirect'])->name('redirect');
        Route::get('/callback', [SpotifyAuthController::class, 'callback'])->name('callback');
        Route::get('/revoke', [SpotifyAuthController::class, 'revoke'])->name('revoke');
    });

});

require __DIR__.'/auth.php';
