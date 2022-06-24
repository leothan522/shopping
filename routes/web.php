<?php

use App\Http\Controllers\Web\AjaxController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});

//*************************************************** Rutas App Android
Route::get('/ogani', function () {
    return view('web.home.index');
});

Route::post('/ogani/busqueda', function () {
    return view('web.home.busqueda');
})->name('busqueda.prueba');

Route::post('/ajax/favoritos', [AjaxController::class, 'favoritos'])->name('ajax.favoritos');
Route::post('/ajax/carrito', [AjaxController::class, 'carrito'])->name('ajax.carrito');

