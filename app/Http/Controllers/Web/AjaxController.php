<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Parametro;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function favoritos(Request $request)
    {
        $id_stock = $request->id_stock;
        $id_usuario = Auth::id();

        $favoritos = Parametro::where('nombre', 'favoritos')
                                ->where('tabla_id', $id_usuario)
                                ->where('valor', $id_stock)
                                ->first();

        $cantidad = Parametro::where('nombre', 'favoritos')
                                ->where('tabla_id', $id_usuario)
                                ->count();
        if ($favoritos){
            $favoritos->delete();
            $cantidad = $cantidad - 1;
            $json = [
                'type' => 'info',
                'message' => 'Eliminado de tus favoritos',
                'cantidad' => $cantidad,
                'id' => "favoritos_$id_stock"
            ];
        }else{
            $favoritos = new Parametro();
            $favoritos->nombre = "favoritos";
            $favoritos->tabla_id = $id_usuario;
            $favoritos->valor = $id_stock;
            $favoritos->save();
            $cantidad = $cantidad + 1;
            $json = [
                'type' => 'success',
                'message' => 'Agregado a tus favoritos.',
                'cantidad' => $cantidad,
                'id' => "favoritos_$id_stock"
            ];
        }

        return response()->json($json);
    }

    public function totalizar($id)
    {
        $totalizar = [];
        $listarCarrito = Carrito::where('users_id', $id)
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
        });
        $subtotal = $listarCarrito->sum('subtotal');
        $iva = $listarCarrito->sum('iva');
        $total = $listarCarrito->sum('total');
        $cantidad = $listarCarrito->sum('cantidad');
        $totalizar['subtotal'] = $subtotal;
        $totalizar['iva'] = $iva;
        $totalizar['cantidad'] = $cantidad;

        $delivery = Delivery::where('users_id', $id)
            ->where('estatus', 0)
            ->first();
        if ($delivery){
            $zona = $delivery->zona->precio;
        }else{
            $zona = 0;
        }

        $totalizar['delivery'] = $zona;
        $totalizar['total'] = $total + $zona;

        return $totalizar;
    }

    public function carrito(Request $request)
    {

        $id_usuario = Auth::id();
        $opcion = $request->opcion;


        if ($opcion == 'sumar' || $opcion == 'agregar'){

            $id_stock = $request->id_stock;
            $cantidad = $request->cantidad;

            $carrito = Carrito::where('users_id', $id_usuario)
                ->where('stock_id', $id_stock)
                ->where('estatus', 0)
                ->first();

            if ($carrito){

                $nueva_cantidad = $carrito->cantidad + $cantidad;
                $nombre = $carrito->stock->producto->nombre;
                $carrito->cantidad = $nueva_cantidad;
                $carrito->update();
                $totalizar = $this->totalizar(Auth::id());

                $json = [
                    'type' => 'info',
                    'message' => "Tienes ".formatoMillares($nueva_cantidad, 0)." ". $nombre,
                    'cantidad' => formatoMillares($totalizar['cantidad'], 0),
                    'items' => formatoMillares($totalizar['total'], 2),
                    'id' => "carrito_$id_stock",
                    'cart' => formatoMillares($totalizar['cantidad'], 0),
                    'opcion' => $opcion,
                    'input' => 'cantAgregar'
                ];
            }else{

                $carrito = new Carrito();
                $carrito->users_id = $id_usuario;
                $carrito->stock_id = $id_stock;
                $carrito->cantidad = $cantidad;
                $carrito->save();
                $totalizar = $this->totalizar(Auth::id());

                $json = [
                    'type' => 'success',
                    'message' => 'Agregado al Carrito.',
                    'cantidad' => formatoMillares($totalizar['cantidad'], 0),
                    'items' => formatoMillares($totalizar['total'], 2),
                    'id' => "carrito_$id_stock",
                    'cart' => formatoMillares($carrito->cantidad, 0),
                    'opcion' => $opcion,
                    'input' => 'cantAgregar',
                ];
            }
        }

        if($opcion == "remover"){

            $id_carrito = $request->id_carrito;
            $tr = $request->tr;

            $carrito = Carrito::find($id_carrito);
            $carrito->delete();
            $totalizar = $this->totalizar(Auth::id());

            $json = [
                'type' => 'success',
                'message' => 'Eliminado del Carrito.',
                'opcion' => $opcion,
                'tr' => $tr,
                'subtotal' => $totalizar['subtotal'],
                'iva' => $totalizar['iva'],
                'total' => $totalizar['total'],
                'delivery' => $totalizar['delivery'],
                'label_delivery' => formatoMillares($totalizar['delivery'], 2),
                'label_subtotal' => formatoMillares($totalizar['subtotal'], 2),
                'label_iva' => formatoMillares($totalizar['iva'], 2),
                'label_total' => formatoMillares($totalizar['total'], 2),
            ];
        }

        if($opcion == "editar"){

            $boton = $request->boton;
            $valor = $request->valor;
            $carrito_id = $request->carrito_id;
            $carrito_item = $request->carrito_item;
            $subtotal = $request->subtotal;
            $iva = $request->iva;
            $total = $request->total;

            $carrito = Carrito::find($carrito_id);
            $carrito_producto = $carrito->stock->productos_id;
            $carrito_cantidad = $carrito->cantidad;
            $carrito_pvp = $carrito->stock->pvp;
            $carrito_precio = calcularIVA($carrito_producto, $carrito_pvp);
            if ($boton == "btn-sumar"){
                $cantidad = $carrito_cantidad + 1;
                $nuevo_item = $carrito_precio * $cantidad;
            }
            if ($boton == "btn-restar"){
                $cantidad = $carrito_cantidad - 1;
                $nuevo_item = $carrito_precio * $cantidad;
            }
            if ($boton == "input"){
                $cantidad = $valor;
                $nuevo_item = $carrito_precio * $cantidad;
            }
            $carrito->cantidad = $cantidad;

            if ($cantidad <= 0){
                $carrito->delete();
                $borrar = "si";
            }else{
                $carrito->update();
                $borrar = "no";
            }

            $totalizar = $this->totalizar(Auth::id());

            $json = [
                'type' => 'success',
                'message' => 'Carrito Actualizado.',
                'valor' => $cantidad,
                'carrito_item' => $carrito_item,
                'label_carrito_item' => formatoMillares($nuevo_item, 2),
                'subtotal' => $totalizar['subtotal'],
                'iva' => $totalizar['iva'],
                'total' => $totalizar['total'],
                'delivery' => $totalizar['delivery'],
                'label_delivery' => formatoMillares($totalizar['delivery'], 2),
                'label_subtotal' => formatoMillares($totalizar['subtotal'], 2),
                'label_iva' => formatoMillares($totalizar['iva'], 2),
                'label_total' => formatoMillares($totalizar['total'], 2),
                'borrar' => $borrar,
                'tr' => "tr_$carrito_id"
            ];
        }

        if($opcion == "remover-delivery"){

            $accion = $request->accion;
            $zona_id = $request->zona;

            if ($accion == "remover"){

                $this->editarZonas("vacia");
                $tipo= "info";
                $mensage = "Desactivado";
                $accion = "incluir";

            }else{

                $this->editarZonas($zona_id);
                $tipo = "success";
                $mensage = "Activado";
                $accion = "remover";

            }

            $totalizar = $this->totalizar(Auth::id());

            $json = [
                'type' => $tipo,
                'message' => "Delivery $mensage.",
                'accion' => $accion,
                'subtotal' => $totalizar['subtotal'],
                'iva' => $totalizar['iva'],
                'total' => $totalizar['total'],
                'delivery' => $totalizar['delivery'],
                'label_delivery' => formatoMillares($totalizar['delivery'], 2),
                'label_subtotal' => formatoMillares($totalizar['subtotal'], 2),
                'label_iva' => formatoMillares($totalizar['iva'], 2),
                'label_total' => formatoMillares($totalizar['total'], 2),
            ];

        }

        if($opcion == "select-delivery"){

            $zona_id = $request->zona;

            $this->editarZonas($zona_id);

            $totalizar = $this->totalizar(Auth::id());

            $json = [
                'type' => 'success',
                'message' => "Delivery Actualizado.",
                'subtotal' => $totalizar['subtotal'],
                'iva' => $totalizar['iva'],
                'total' => $totalizar['total'],
                'delivery' => $totalizar['delivery'],
                'label_delivery' => formatoMillares($totalizar['delivery'], 2),
                'label_subtotal' => formatoMillares($totalizar['subtotal'], 2),
                'label_iva' => formatoMillares($totalizar['iva'], 2),
                'label_total' => formatoMillares($totalizar['total'], 2),
            ];
        }




        return response()->json($json);
    }

    public function editarZonas($zona_id)
    {
        if ($zona_id != "vacia"){

            $delivery = Delivery::where('users_id', Auth::id())
                ->where('estatus', 0)
                ->first();
            if ($delivery){
                $delivery->zonas_id = $zona_id;
                $delivery->update();
            }else{
                $delivery = new Delivery();
                $delivery->users_id = Auth::id();
                $delivery->zonas_id = $zona_id;
                $delivery->save();
            }

        }else{
            $delivery = Delivery::where('users_id', Auth::id())
                ->where('estatus', 0)
                ->first();
            if ($delivery){
                $delivery->delete();
            }
        }
    }

}
