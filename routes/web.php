<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\AuthController::class, 'index']);
Route::post('/auth/login', [Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [Controllers\AuthController::class, 'logout']);

    Route::prefix('admin')->group(function () {
        Route::resource('citas', Controllers\Assistant\DatingController::class);
        Route::resource('tipos-de-tramites', Controllers\Assistant\FormalityTypeController::class);
        Route::resource('tipos-de-tramites/{formalityId}/etapas', Controllers\Assistant\FormalityTypeStepController::class);
        Route::resource('documentos', Controllers\Assistant\DocumentController::class);
        Route::resource('usuarios', Controllers\Assistant\UserController::class);
        Route::resource('clientes', Controllers\Assistant\CustomerController::class);
        Route::resource('tramites', Controllers\Assistant\FormalityController::class);
    });
});
