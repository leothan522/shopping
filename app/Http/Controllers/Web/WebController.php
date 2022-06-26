<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Delivery;
use App\Models\Empresa;
use App\Models\Parametro;
use App\Models\Stock;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{

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
        $carrito['ruta'] = 'web';
        return $carrito;
    }

    public function home()
    {
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
            ->with('ruta', $carrito['ruta'])
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
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('stock', $stock)
            ->with('cantCarrito', $cantidad)
            ->with('listarRelacionados', $listarRelacionados)
            ->with('listarBanner', $banner);
    }

    public function verCarrito()
    {
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $listarCarrito = Carrito::where('users_id', Auth::id())
            ->where('estatus', 0)
            ->get();
        $listarCarrito->each(function ($carrito){
            $id_producto = $carrito->stock->productos_id;
            $cantidad = $carrito->cantidad;
            $pvp = $carrito->stock->pvp;
            $precio = calcularIVA($id_producto, $pvp);
            $iva = calcularIVA($id_producto, $pvp, true);
            $carrito->iva = $iva * $cantidad;
            $carrito->subtotal = $pvp * $cantidad;
            $carrito->total = $precio * $cantidad;
            $carrito->item = $carrito->total;
            $carrito->precio = $precio;
        });

        $subtotal = $listarCarrito->sum('subtotal');
        $iva = $listarCarrito->sum('iva');
        $total = $listarCarrito->sum('total');

        $zonas = Zona::orderBy('nombre', 'ASC')->get();
        $zonas->each(function ($zona){
            $zona->nombre = $zona->nombre." [Costo = $".formatoMillares($zona->precio)."]";
        });

        $delivery = Delivery::where('users_id', Auth::id())
            ->where('estatus', 0)
            ->first();
        if ($delivery){
            $delivery_zona = $delivery->zonas_id;
            $delivery_nombre = $delivery->zona->nombre." [Costo = $".formatoMillares($delivery->zona->precio)."]";
            $delivery_precio = $delivery->zona->precio;
        }else{
            $delivery_zona = null;
            $delivery_nombre = null;
            $delivery_precio = 0;
        }

        $total = $total + $delivery_precio;


        return view('web.carrito.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('listarCarrito', $listarCarrito)
            ->with('subtotal', $subtotal)
            ->with('iva', $iva)
            ->with('total', $total)
            ->with('listarZonas', $zonas)
            ->with('delivery_zona', $delivery_zona)
            ->with('delivery_nombre', $delivery_nombre)
            ->with('delivery_precio', $delivery_precio)
            ;
    }
}
