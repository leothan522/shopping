<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Parametro;
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
                $cant = $carrito->cantidad + $cantidad;
                $nombre = $carrito->stock->producto->nombre;
                $carrito->cantidad = $cant;
                $carrito->update();

                $listaCarrito = Carrito::where('users_id', $id_usuario)
                    ->where('estatus', 0)
                    ->get();

                $suma = null;
                foreach ($listaCarrito as $carrito){
                    $precio = calcularIVA($carrito->stock_id, $carrito->stock->pvp);
                    $suma = $suma + ($precio * $carrito->cantidad);
                }

                $total = Carrito::where('users_id', $id_usuario)
                    ->where('estatus', 0)->sum('cantidad');

                $json = [
                    'type' => 'info',
                    'message' => "Tienes ".formatoMillares($cant, 0)." ". $nombre,
                    'cantidad' => formatoMillares($total, 0),
                    'items' => formatoMillares($suma, 2),
                    'id' => "carrito_$id_stock",
                    'cart' => formatoMillares($cant, 0),
                    'opcion' => $opcion,
                    'input' => 'cantAgregar'
                ];
            }else{

                $carrito = new Carrito();
                $carrito->users_id = $id_usuario;
                $carrito->stock_id = $id_stock;
                $carrito->cantidad = $cantidad;
                $carrito->save();

                $listaCarrito = Carrito::where('users_id', $id_usuario)
                    ->where('estatus', 0)
                    ->get();

                $suma = null;
                foreach ($listaCarrito as $carrito){
                    $precio = calcularIVA($carrito->stock_id, $carrito->stock->pvp);
                    $suma = $suma + ($precio * $carrito->cantidad);
                }

                $total = Carrito::where('users_id', $id_usuario)
                    ->where('estatus', 0)->sum('cantidad');

                $json = [
                    'type' => 'success',
                    'message' => 'Agregado al Carrito.',
                    'cantidad' => formatoMillares($total, 0),
                    'items' => formatoMillares($suma, 2),
                    'id' => "carrito_$id_stock",
                    'cart' => formatoMillares($cantidad, 0),
                    'opcion' => $opcion,
                    'input' => 'cantAgregar'
                ];
            }
        }

        if($opcion == "remover"){

            $id_carrito = $request->id_carrito;
            $tr = $request->tr;
            $subtotal = $request->subtotal;
            $iva = $request->iva;
            $total = $request->total;

            $carrito = Carrito::find($id_carrito);
            $cantidad = $carrito->cantidad;
            $pvp = $carrito->stock->pvp;
            $carrito_iva = calcularIVA($carrito->stock->productos_id, $carrito->stock->pvp, true);
            $carrito_subtotal = $pvp * $cantidad;
            $carrito_total = $carrito_subtotal + $carrito_iva;
            $nuevo_subtotal = $subtotal - $carrito_subtotal;
            $nuevo_iva = $iva - $carrito_iva;
            $nuevo_total = $total - $carrito_total;

            $carrito->delete();

            $json = [
                'type' => 'success',
                'message' => 'Eliminado del Carrito.',
                'opcion' => $opcion,
                'tr' => $tr,
                'subtotal' => $nuevo_subtotal,
                'iva' => $nuevo_iva,
                'total' => $nuevo_total,
                'label_subtotal' => formatoMillares($nuevo_subtotal, 2),
                'label_iva' => formatoMillares($nuevo_iva, 2),
                'label_total' => formatoMillares($nuevo_total, 2),
            ];
        }

        if($opcion == "editar"){
            $id_carrito = $request->id_carrito;
            $boton = $request->boton;
            $valor = $request->valor;
            $subtotal = $request->subtotal;
            $iva = $request->iva;
            $total = $request->total;

            $carrito = Carrito::find($id_carrito);
            $id_stock = $carrito->stock->id;
            $pvp = $carrito->stock->pvp;
            $precio = calcularIVA($id_carrito, $pvp);
            $cantidad = $carrito->cantidad;

            $item_subtotal = null;

            if ($boton == "btn-sumar"){
                $cantidad++;
                $item_subtotal = $cantidad * $precio;
                $nuevo_subtotal = $subtotal + $pvp;
            }


            $json = [
                'type' => 'success',
                'message' => 'Carrito Actualizado.',
            ];
        }




        return response()->json($json);
    }

}
