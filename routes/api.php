<?php

use App\Http\Controllers\APIController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// listado de api

Route::get('/categorias', [APIController::class, 'categorias'])->name('APIController.categorias');
Route::get('/categoria/{categoria}', [APIController::class, 'categoria'])->name('APIController.categoria');
Route::get('/establecimiento/{establecimiento}', [APIController::class, 'show'])->name('APIController.show');
