<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\SessionController as ApiSessionController;

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

Route::post('login', [ApiAuthController::class, 'login'])->name('login');
Route::post('register', [ApiAuthController::class, 'register'])->name('register');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [ApiAuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [ApiAuthController::class, 'refresh'])->name('refresh');

    Route::prefix('sessions')->controller(ApiSessionController::class)->group(function () {
        Route::get('/finished', 'indexFinished');
        Route::post('/', 'index');
        Route::post('/start', 'start');
        Route::post('/store-answer', 'storeAnswer');
    });
});
