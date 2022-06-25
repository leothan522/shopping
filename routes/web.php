<?php

use App\Http\Controllers\Web\AjaxController;
use App\Http\Controllers\Web\AppController;
use Illuminate\Support\Facades\Auth;
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
    'verified',
    'isadmin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});


Route::get('/cerrar', function () {
    Auth::logout();
    return redirect('/');
})->name('cerrar');



Route::middleware(['android'])->prefix('/android')->group(function (){

    Route::get('/ogani', function () {
        return view('web.carrito.index');
    });

    Route::post('/ogani/busqueda', function () {
        return view('web.home.busqueda');
    })->name('busqueda.prueba');

    Route::get('/{id}/home', [AppController::class, 'home'])->name('shop.home');
    Route::get('/{id}/detalles', [AppController::class, 'verDetalles'])->name('shop.detalles');
    Route::get('/{id}/carrito', [AppController::class, 'verCarrito'])->name('shop.carrito');

    Route::post('/ajax/favoritos', [AjaxController::class, 'favoritos'])->name('ajax.favoritos');
    Route::post('/ajax/carrito', [AjaxController::class, 'carrito'])->name('ajax.carrito');
});
