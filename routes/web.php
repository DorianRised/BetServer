<?php

use App\Http\Controllers\ApuestaController;
use App\Http\Controllers\TipsterController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeporteController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipoApuestaController;
use App\Http\Controllers\ParlayController;
use App\Http\Controllers\EquipoController;
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

// Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);

    
// });


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
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
    Route::resource('/eventos', EventoController::class);
    Route::resource('/deportes', DeporteController::class);
    Route::resource('/ligas', LigaController::class);
    Route::resource('/grupos', GrupoController::class);
    Route::resource('/tipsters', TipsterController::class);
    Route::resource('/usuarios', UserController::class);
    Route::resource('/tipo-apuestas', TipoApuestaController::class);
    Route::resource('/parlays', ParlayController::class);
    Route::resource('/equipos', EquipoController::class);
});
