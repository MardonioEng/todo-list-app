<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('usuarios')->group(function () {
    Route::get('/', [\App\Http\Controllers\UsuarioController::class, 'buscar']);
    Route::get('/{id:int}', [\App\Http\Controllers\UsuarioController::class, 'visualizar']);
    Route::post('/', [\App\Http\Controllers\UsuarioController::class, 'inserir']);
    Route::put('/{id:int}', [\App\Http\Controllers\UsuarioController::class, 'editar']);
    Route::patch('/alterar-senha/{id:int}', [\App\Http\Controllers\UsuarioController::class, 'alterarSenha']);
});



