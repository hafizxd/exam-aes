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

Route::get('/key', function () {
    // dd(base64_decode(substr(env('APP_KEY'), 7)));

    // dd(base64_decode('eyJpdiI6Ild1R0NhdjJvLzBjanBXc0k2bm5LR2c9PSIsInZhbHVlIjoiWW1ORFlvK1lQeGU0K0xKTmdQUFZPeHdHcU1lNmYvK1dUdnVoQktFeFlwUT0iLCJtYWMiOiIzZTY5NjY0Y2M5MjAyZDIzZjgwMDkyYmM0OWE4MTg2ZjNjYjQzZjNkY2Q2MTJhOGJiNTBlN2UwZjUzMGZmZjE4IiwidGFnIjoiIn0='));
    dd(decrypt('eyJpdiI6Ild1R0NhdjJvLzBjanBXc0k2bm5LR2c9PSIsInZhbHVlIjoiWW1ORFlvK1lQeGU0K0xKTmdQUFZPeHdHcU1lNmYvK1dUdnVoQktFeFlwUT0iLCJtYWMiOiIzZTY5NjY0Y2M5MjAyZDIzZjgwMDkyYmM0OWE4MTg2ZjNjYjQzZjNkY2Q2MTJhOGJiNTBlN2UwZjUzMGZmZjE4IiwidGFnIjoiIn0='));
    $iv = random_bytes(openssl_cipher_iv_length(strtolower('aes-256-cbc')));
    $enc = \openssl_encrypt(
        serialize('aku'),
        strtolower('aes-256-cbc'),
        'somerandomkeyof32byteslongthisis',
        0,
        $iv
    );
    dd($iv);

    // $newEncrypter = new \Illuminate\Encryption\Encrypter('somerandomkeyof32byteslongthisis', Config::get('app.cipher'));
    // $encrypted = $newEncrypter->encrypt('aku');
    // $decrypted = $newEncrypter->decrypt($encrypted);
    // dd($encrypted);
});

Route::middleware('web.auth')->group(function () {
    Route::group(['prefix' => 'sessions', 'as' => 'session.', 'controller' => SessionController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('{id}', 'edit')->name('edit');
        Route::put('{id}/update', 'update')->name('update');
        Route::delete('{id}/delete', 'delete')->name('delete');

        Route::get('{id}/attendants/{attendantId}', 'showAttendant')->name('attendant.show');
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
