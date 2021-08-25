<?php

use App\Http\Controllers\ArticlesController;
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
Route::prefix('v1')->group(function () {
    Route::post('/register', 'App\Http\Controllers\RegisterController@register');

    Route::get('email/verify/{id}', 'App\Http\Controllers\VerificationController@verify')->name('verification.verify');

    Route::post('/login', 'App\Http\Controllers\AuthenticationController@login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/logout', 'App\Http\Controllers\AuthenticationController@logout');

        Route::resource('article', ArticlesController::class, [
            'only' => [
                'index',
                'store',
                'show',
            ],
        ])->parameters([
                           'article' => 'id',
                       ]);
    });
});
