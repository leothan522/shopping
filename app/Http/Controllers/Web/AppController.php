<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Delivery;
use App\Models\Empresa;
use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Stock;
use App\Models\User;
use App\Models\Zona;
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
        return Parametro::where('nombre', 'LIKE', "%favoritos%")->where('tabla_id', Auth::id())->count();
    }

    public function headerCarrito()
    {
        $carrito = [];
        $carritos = Carrito::where('users_id', Auth::id())->where('estatus', 0)->get();
        $suma= null;
        foreach ($carritos as $cart){
            $precio = calcularPrecio($cart->stock_id, $cart->stock->pvp);
            $suma = $suma + ($precio * $cart->cantidad);
        }

        $delivery = Delivery::where('users_id', Auth::id())
            ->where('estatus', 0)
            ->first();
        if ($delivery){
            $zona = $delivery->zona->precio;
        }else{
            $zona = 0;
        }

        $carrito['total'] = $suma + $zona;
        $carrito['items'] = $carritos->sum('cantidad');
        $carrito['ruta'] = 'android';
        return $carrito;
    }

    public function home($user)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $categorias = Categoria::where('tipo', 0)->orderBy('nombre')->get();

        /*$destacados = Stock::orderBy('stock_vendido', 'DESC')
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(12)
            ->get();
        $destacados->each(function ($stock){
            $favoritos = Parametro::where('nombre', 'favoritos_productos')
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
        });*/

        $destacados = Stock::orderBy('stock_vendido', 'DESC')
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(12)
            ->get();
        $destacados->each(function ($stock){
            $favoritos = Parametro::where('nombre', 'favoritos_tiendas')
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
            ->with('listarRevisar', $revisar)
            ->with('modulo', 'HOME')
            ->with('titulo', null);

    }

    public function verDetalles($user, $id)
    {
        $this->autenticar($user);
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

        $favor = Parametro::where('nombre', 'favoritos_productos')
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
            $favoritos = Parametro::where('nombre', 'favoritos_productos')
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
            ->get();



        return view('web.detalles.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('stock', $stock)
            ->with('cantCarrito', $cantidad)
            ->with('listarRelacionados', $listarRelacionados)
            ->with('listarBanner', $banner)
            ->with('modulo', 'Detalles')
            ->with('titulo', $stock->producto->nombre);
    }

    public function verCarrito($user)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $listarCarrito = Carrito::where('users_id', Auth::id())
            ->where('estatus', 0)
            ->get();
        $listarCarrito->each(function ($carrito){

            $id_producto = $carrito->stock->productos_id;
            $cantidad = $carrito->cantidad;
            $pvp = $carrito->stock->pvp;
            $precio = calcularPrecio($carrito->stock_id, $pvp);
            $iva = calcularPrecio($carrito->stock_id, $pvp, true);
            $carrito->iva = $iva * $cantidad;
            $carrito->subtotal = $cantidad * ($precio - $iva);
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
            ->with('modulo', 'Carrito')
            ->with('titulo', null)
            ;
    }

    public function verCategorias($user, $id)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $categoria = Categoria::find($id);

        $productos = Producto::where('categorias_id', $categoria->id)->get();
        $productos->each(function ($producto){
            $destacados = Stock::orderBy('stock_vendido', 'DESC')
                ->where('estatus', 1)
                ->where('stock_disponible', '>', 0)
                ->where('productos_id', $producto->id)
                ->get();
            $destacados->each(function ($stock){
                $favoritos = Parametro::where('nombre', 'favoritos_productos')
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
                $stock->cantidad = $stock->cantidad + 1;
                $stock->empresa = Empresa::find($stock->empresas_id);
            });
            $producto->cantidad = $destacados->sum('cantidad');
            $producto->stock = $destacados;
        });

        $cantidad  = $productos->sum('cantidad');

        $ultimos = Stock::orderBy('id', 'DESC')
            ->where('estatus', 1)
            ->where('stock_disponible', '>', 0)
            ->limit(6)
            ->get();


        return view('web.categorias.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Categoria')
            ->with('titulo', $categoria->nombre)
            ->with('categoria', $categoria)
            ->with('listarProductos', $productos)
            ->with('cantidad', $cantidad)
            ->with('listarUltimos', $ultimos);
    }

    public $arrayFavoritos = array();
    public $arrayTiendas = array();


    public function verFavoritos($user)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();
        //$verFavoritos = null;

        $listarFavoritos = Parametro::where('nombre', 'favoritos_productos')
            ->where('tabla_id', Auth::id())
            ->get();
        //dd($listarFavoritos->count());
        if ($listarFavoritos->count()){
            $listarFavoritos->each(function ($parametro){
                $ultimos = Stock::orderBy('id', 'DESC')
                    //->where('estatus', 1)
                    //->where('stock_disponible', '>', 0)
                    ->where('id', $parametro->valor)
                    ->get();
                $ultimos->each(function ($stock){
                    array_push($this->arrayFavoritos, $stock->id);
                });
            });

            foreach ($this->arrayFavoritos as $key => $id) {
                $stock = Stock::find($id);
                $verFavoritos[$key] = collect(array(
                    'id'            => $stock->id,
                    'miniatura'     => $stock->producto->miniatura,
                    'nombre'        => $stock->producto->nombre,
                    'producto_id'   => $stock->id,
                    'pvp'           => $stock->pvp,
                    'moneda'        => '$',//$stock->empresa->moneda,
                    'estatus'       => $stock->estatus
                ));
            }
        }else{
            $verFavoritos = null;
        }

        $listarFavoritos = Parametro::where('nombre', 'favoritos_tiendas')
            ->where('tabla_id', Auth::id())
            ->get();
        //dd($listarFavoritos->count());
        if ($listarFavoritos->count()){
            $listarFavoritos->each(function ($parametro){
                $ultimos = Stock::orderBy('id', 'DESC')
                    //->where('estatus', 1)
                    //->where('stock_disponible', '>', 0)
                    ->where('id', $parametro->valor)
                    ->get();
                $ultimos->each(function ($stock){
                    array_push($this->arrayTiendas, $stock->id);
                });
            });

            foreach ($this->arrayTiendas as $key => $id) {
                $stock = Stock::find($id);
                $verTiendas[$key] = collect(array(
                    'id'            => $stock->empresas_id,
                    'miniatura'     => $stock->empresa->miniatura,
                    'nombre'        => $stock->empresa->nombre,
                ));
            }
        }else{
            $verTiendas = null;
        }



        return view('web.favoritos.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Favoritos')
            ->with('titulo', null)
            ->with('listarFavoritos', $verFavoritos)
            ->with('listarTiendas', $verTiendas);
    }

    public function verCheckout($user, $id = null)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $pedido = Pedido::findOrFail($id);

        if ($pedido->estatus > 0 && $pedido->estatus != 4){
            return redirect()->route('android.pedidos', [Auth::id(), $pedido->id]);
        }

        $listarCarrito = Carrito::where('pedidos_id', $pedido->id)->get();
        $listarMetodos = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 1)->get();
        $listarMetodos->each(function ($parametro){
            $nombre = str_replace("_", " ", $parametro->valor);
            if ($parametro->valor == 'movil'){
                $nombre = "pago movil";
            }
            $parametro->metodo = ucwords($nombre);
        });

        if ($pedido->metodo_pago){
            $parametro = Parametro::find($pedido->metodo_pago);
            $nombre = str_replace("_", " ", $parametro->valor);
            if ($parametro->valor == 'movil'){
                $nombre = "pago movil";
            }
            $pedido->revisar = $nombre;
        }

        if ($pedido->cedula){
            $cliente = Cliente::where('cedula', $pedido->cedula)->first();
            $pedido->cliente_id = $cliente->id;
        }

        $dolarParametro = Parametro::where('nombre', 'precio_dolar')->first();
        if ($dolarParametro){
            $precio_dolar = floatval($dolarParametro->valor);
        }else{
            $precio_dolar = 1;
        }

        //dd($precio_dolar);

        if ($precio_dolar != floatval($pedido->precio_dolar)){
            $pedido->precio_dolar = $precio_dolar;
            $pedido->bs = $pedido->total * $precio_dolar;
            $pedido->update();
        }


        return view('web.checkout.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Checkout')
            ->with('titulo', null)
            ->with('pedido', $pedido)
            ->with('listarCarrito', $listarCarrito)
            ->with('listarMetodos', $listarMetodos)
            ;

    }

    public function verPedidos($user, $id = null)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        if (is_null($id)){
            $buscar = Pedido::where('users_id', Auth::id())->orderBy('id', 'DESC')->first();
            if ($buscar){
                $pedido = $buscar;
                $listarCarrito = Carrito::where('pedidos_id', $pedido->id)->get();
            }else{
                $pedido = null;
                $listarCarrito = null;
            }
        }else{
            $pedido = Pedido::findOrFail($id);
            if ($pedido->estatus == 0 || $pedido->estatus == 4){
                return redirect()->route('android.checkout', [Auth::id(), $pedido->id]);
            }
            $listarCarrito = Carrito::where('pedidos_id', $pedido->id)->get();
            $listarMetodos = Parametro::where('nombre', 'metodo_pago')->where('tabla_id', 1)->get();
        }

        $listarPedidos = Pedido::where('users_id', Auth::id())
            ->orderBy('numero', 'DESC')
            ->get();

        //dd($listarPedidos);


        return view('web.pedidos.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Checkout')
            ->with('titulo', null)
            ->with('pedido', $pedido)
            ->with('listarCarrito', $listarCarrito)
            ->with('listarPedidos', $listarPedidos)
            ;

    }

    public function verBusqueda($user, Request $request)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $productos = Producto::where('nombre', 'LIKE', "%$request->buscar%")->get();
        $productos->each(function ($producto){
            $stock = Stock::where('productos_id', $producto->id)
                /*->where('stock_disponible', '>', 0)
                ->where('estatus', 1)*/
                ->get();
            $producto->stock = $stock;
        });


        return view('web.busqueda.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Busqueda')
            ->with('titulo', $request->buscar)
            ->with('listarProductos', $productos)
            ;

    }

    public function verTienda($user, $id)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $empresa = Empresa::findOrFail($id);

        $stock = Stock::where('empresas_id', $id)
            ->where('stock_disponible', '>', 0)
            ->where('estatus', 1)
            ->get();


        return view('web.busqueda.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Tienda')
            ->with('titulo', $empresa->nombre)
            ->with('listarProductos', $stock)
            ->with('empresa', $empresa)
            ;

    }

    public function listarCategorias($user)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $listarCategorias = Categoria::where('tipo', 0)->orderBy('nombre', 'ASC')->get();

        return view('web.categorias.listar_categorias')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Categorias')
            ->with('titulo', null)
            ->with('listarCategorias', $listarCategorias);
    }

    public function listarTiendas($user)
    {
        $this->autenticar($user);
        $favoritos = $this->headerFavoritos();
        $carrito = $this->headerCarrito();

        $listarTiendas = Empresa::orderBy('nombre', 'ASC')->get();

        return view('web.empresas.index')
            ->with('ruta', $carrito['ruta'])
            ->with('headerFavoritos', $favoritos)
            ->with('headerItems', $carrito['items'])
            ->with('headerTotal', $carrito['total'])
            ->with('modulo', 'Tiendas')
            ->with('titulo', null)
            ->with('listarTiendas', $listarTiendas);
    }

}
