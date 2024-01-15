<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web.auth')->group(function () {
    Route::group(['prefix' => 'sessions', 'as' => 'session.', 'controller' => SessionController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}', 'edit')->name('edit');
        Route::put('{id}/update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');
    });

    Route::group(['prefix' => 'tests', 'as' => 'test.', 'controller' => TestController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}', 'edit')->name('edit');
        Route::put('{id}/update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');

        Route::group(['prefix' => '{id}/questions', 'as' => 'question.'], function () {
            Route::get('create', 'questionCreate')->name('create');
            Route::post('store', 'questionStore')->name('store');
            Route::get('{questionId}', 'questionEdit')->name('edit');
            Route::put('{questionId}/update', 'questionUpdate')->name('update');
            Route::delete('{questionId}/delete', 'questionDelete')->name('delete');
        });
    });
});

require __DIR__ . '/auth.php';
