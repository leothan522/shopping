<?php

use App\Http\Controllers\Web\AjaxController;
use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\WebController;
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

    Route::get('/{id}/home', [AppController::class, 'home'])->name('android.home');
    Route::get('/{id}/detalles', [AppController::class, 'verDetalles'])->name('android.detalles');
    Route::get('/{id}/carrito', [AppController::class, 'verCarrito'])->name('android.carrito');
    Route::get('/{id}/categorias', [AppController::class, 'verCategorias'])->name('android.categorias');
    Route::get('/{id}/favoritos', [AppController::class, 'verFavoritos'])->name('android.favoritos');

});

Route::middleware(['auth'])->prefix('/web')->group(function (){

    Route::post('/ajax/favoritos', [AjaxController::class, 'favoritos'])->name('ajax.favoritos');
    Route::post('/ajax/carrito', [AjaxController::class, 'carrito'])->name('ajax.carrito');

    Route::get('/home', [WebController::class, 'home'])->name('web.home');
    Route::get('/{id}/detalles', [WebController::class, 'verDetalles'])->name('web.detalles');
    Route::get('/carrito', [WebController::class, 'verCarrito'])->name('web.carrito');
    Route::get('/{id}/categorias', [WebController::class, 'verCategorias'])->name('web.categorias');
    Route::get('/favoritos', [WebController::class, 'verFavoritos'])->name('web.favoritos');

    Route::get('/perfil', function (){
        return view('profile.show_default');
    })->name('web.perfil');


});
