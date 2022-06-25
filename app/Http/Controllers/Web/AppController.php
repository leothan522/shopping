<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Parametro;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AppController extends Controller
{
    public function autenticar($id)
    {
        $user = User::findOrFail($id);
         Auth::loginUsingId($user->id, true);
    }

    public function headerFavoritos()
    {
        return Parametro::where('nombre', 'favoritos')->where('tabla_id', Auth::id())->count();
    }

    public function headerCarrito()
    {
        $carrito = [];
        $carritos = Carrito::where('users_id', Auth::id())->where('estatus', 0)->get();
        $suma= null;
        foreach ($carritos as $cart){
            $precio = calcularIVA($cart->stock_id, $cart->stock->pvp);
            $suma = $suma + ($precio * $cart->cantidad);
        }
        $carrito['total'] = $suma;
        $carrito['items'] = $carritos->sum('cantidad');
        return $carrito;
    }

    public function home($id)
    {
        $this->autenticar($id);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $categorias = Categoria::orderBy('nombre')->get();

        $destacados = Stock::orderBy('stock_vendido', 'DESC')
                    ->where('estatus', 1)
                    ->where('stock_disponible', '>', 0)
                    ->limit(12)
                    ->get();
        $destacados->each(function ($stock){
            $favoritos = Parametro::where('nombre', 'favoritos')
                                    ->where('tabla_id', Auth::id())
                                    ->where('valor', $stock->id)->first();
            if ($favoritos){
                $stock->favoritos = true;
            }else{
                $stock->favoritos = false;
            }
            $carrito = Carrito::where('stock_id', $stock->id)
                ->where('users_id', Auth::id())
                ->where('estatus', 0)->first();
            if ($carrito){
                $stock->carrito = true;
            }else{
                $stock->carrito = false;
            }
        });


        $banner = Empresa::orderByRaw("RAND()")
                    ->limit(2)
                    ->get();

        $ultimos = Stock::orderBy('id', 'DESC')
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(6)
            ->get();

        $primeros = Stock::orderBy('id', 'ASC')
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(6)
            ->get();

        $revisar = Stock::orderByRaw("RAND()")
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(6)
            ->get();


        return view('web.home.index')
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('listarCategorias', $categorias)
            ->with('listarDestacados', $destacados)
            ->with('listarBanner', $banner)
            ->with('listarUltimos', $ultimos)
            ->with('listarPrimeros', $primeros)
            ->with('listarRevisar', $revisar);

    }

    public function verDetalles($id)
    {
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $stock = Stock::find($id);

        $cart = Carrito::where('stock_id', $stock->id)
            ->where('users_id', Auth::id())
            ->where('estatus', 0)
            ->first();
        if ($cart){
            if ($stock->producto->decimales){
                $cantidad = formatoMillares($cart->cantidad, 2);
            }else{
                $cantidad = $cantidad = formatoMillares($cart->cantidad, 0);
            }
        }else{
            $cantidad = 0;
        }

        $favor = Parametro::where('nombre', 'favoritos')
            ->where('tabla_id', Auth::id())
            ->where('valor', $stock->id)->first();
        if ($favor){
            $stock->favoritos = true;
        }else{
            $stock->favoritos = false;
        }

        $listarRelacionados = Stock::where('empresas_id', $stock->empresas_id)
            ->where('stock_disponible', '>', 0)
            ->where('id', '!=', $stock->id)
            ->limit(4)
            ->orderBy('stock_disponible', 'DESC')
            ->get();
        $listarRelacionados->each(function ($stock){
            $favoritos = Parametro::where('nombre', 'favoritos')
                ->where('tabla_id', Auth::id())
                ->where('valor', $stock->id)->first();
            if ($favoritos){
                $stock->favoritos = true;
            }else{
                $stock->favoritos = false;
            }
            $carrito = Carrito::where('stock_id', $stock->id)
                ->where('users_id', Auth::id())
                ->where('estatus', 0)->first();
            if ($carrito){
                $stock->carrito = true;
            }else{
                $stock->carrito = false;
            }
        });

        $banner = Empresa::where('id', $stock->empresas_id)
            ->limit(1)
            ->get();;



        return view('web.detalles.index')
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('stock', $stock)
            ->with('cantCarrito', $cantidad)
            ->with('listarRelacionados', $listarRelacionados)
            ->with('listarBanner', $banner);
    }

    public function verCarrito($id)
    {
        $this->autenticar($id);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $listarCarrito = Carrito::where('users_id', Auth::id())
            ->where('estatus', 0)
            ->get();
        $listarCarrito->each(function ($carrito){
            $carrito->pvp = $carrito->stock->pvp * $carrito->cantidad;
            $carrito->precio = calcularIVA($carrito->stock->productos_id, $carrito->stock->pvp);
            $carrito->iva = calcularIVA($carrito->stock->productos_id, $carrito->stock->pvp, true);
            $subtotal = $carrito->precio * $carrito->cantidad;
            $carrito->item_total = $subtotal;
            $carrito->total = $carrito->pvp + $carrito->iva;
        });

        $subtotal = $listarCarrito->sum('pvp');
        $iva = $listarCarrito->sum('iva');
        $total = $listarCarrito->sum('total');


        return view('web.carrito.index')
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('listarCarrito', $listarCarrito)
            ->with('subtotal', $subtotal)
            ->with('iva', $iva)
            ->with('total', $total);
    }





}
