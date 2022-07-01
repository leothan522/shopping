<?php

use App\Http\Controllers\Dashboard\AlmacenController;
use App\Http\Controllers\Dashboard\CategoriasController;
use App\Http\Controllers\Dashboard\ClientesController;
use App\Http\Controllers\Dashboard\DeliveryController;
use App\Http\Controllers\Dashboard\EmpresasController;
use App\Http\Controllers\Dashboard\MetodosController;
use App\Http\Controllers\Dashboard\ParametrosController;
use App\Http\Controllers\Dashboard\PedidosController;
use App\Http\Controllers\Dashboard\ProductosController;
use App\Http\Controllers\Dashboard\SearchController;
use App\Http\Controllers\Dashboard\StockController;
use App\Http\Controllers\Dashboard\UsersController;
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

Route::match(
    ['get', 'post'],
    '/dashboard/navbar/search',
    [SearchController::class, 'showNavbarSearchResults']
)->middleware(['auth', 'isadmin', 'estatus']);

Route::middleware(['auth', 'isadmin', 'estatus', 'permisos'])->prefix('/dashboard')->group(function (){

    Route::get('parametros/{parametro?}', [ParametrosController::class, 'index'])->name('parametros.index');
    Route::get('usuarios/{usuario?}', [UsersController::class, 'index'])->name('usuarios.index');
    Route::get('export/usuarios/{buscar?}', [UsersController::class, 'export'])->name('usuarios.excel');
    Route::get('pdf/usuarios', [UsersController::class, 'createPDF'])->name('usuarios.pdf');
    Route::get('empresas', [EmpresasController::class, 'index'])->name('empresas.index');
    Route::get('categorias/{categoria?}', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('productos/{producto?}', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('delivery/{buscar?}', [DeliveryController::class, 'index'])->name('delivery.index');
    Route::get('almacen/{buscar?}', [AlmacenController::class, 'index'])->name('almacen.index');
    Route::get('metodos', [MetodosController::class, 'index'])->name('metodos.index');
    Route::get('stock/{buscar?}', [StockController::class, 'index'])->name('stock.index');
    Route::get('pedidos/{buscar?}', [PedidosController::class, 'index'])->name('pedidos.index');

    //pendientes


    Route::get('clientes', [ClientesController::class, 'index'])->name('clientes.index');







});

Route::get('/prueba', function () {
    return view('dashboard.blank');
})->middleware(['auth', 'isadmin', 'estatus'])->name('prueba');
