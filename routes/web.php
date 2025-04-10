<?php

use App\Http\Controllers\ApuestaController;
use App\Http\Controllers\TipsterController;
use App\Http\Controllers\HomeController;
use App\Models\Tipster;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');    
    // })->name('dashboard');

    Route::get('/dashboard', [HomeController::class, 'indexAdmin'])->name('dashboard');

    Route::resource('/tipsters', TipsterController::class);
    Route::resource('/apuestas', ApuestaController::class);

});
