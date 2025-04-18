<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('tipsters', App\Http\Controllers\API\TipsterAPIController::class)
    ->except(['create', 'edit']);

Route::resource('apuestas', App\Http\Controllers\API\ApuestaAPIController::class)
    ->except(['create', 'edit']);

Route::resource('deportes', App\Http\Controllers\API\DeporteAPIController::class)
    ->except(['create', 'edit']);

Route::resource('resultados', App\Http\Controllers\API\ResultadoAPIController::class)
    ->except(['create', 'edit']);

Route::resource('ligas', App\Http\Controllers\API\LigaAPIController::class)
    ->except(['create', 'edit']);

Route::resource('grupos', App\Http\Controllers\API\GrupoAPIController::class)
    ->except(['create', 'edit']);

Route::resource('eventos', App\Http\Controllers\API\EventoAPIController::class)
    ->except(['create', 'edit']);