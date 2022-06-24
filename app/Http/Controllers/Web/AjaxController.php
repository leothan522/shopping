<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function favoritos(Request $request)
    {
        $favoritos = true;
        if ($favoritos){
            $json = [
                'type' => 'success',
                'message' => 'Agregado a tus favoritos.',
                'cantidad' => 2,
                /*'id' => "favoritos_id_producto",
                'clase' => "favoritos_id_producto",*/

            ];
        }else{
            $json = [
                'type' => 'info',
                'message' => 'Eliminado de tus favoritos',
                'cantidad' => 1,
                /*'id' => "favoritos_id_producto",
                'clase' => "favoritos_id_producto",*/
            ];
        }
        return response()->json($json);
    }

    public function carrito(Request $request)
    {
        $carrito = true;
        if ($carrito){
            $json = [
                'type' => 'success',
                'message' => 'Agregado al Carrito.',
                'cantidad' => 88,
                /*'id' => "favoritos_id_producto",
                'clase' => "favoritos_id_producto",*/

            ];
        }else{
            $json = [
                'type' => 'info',
                'message' => 'Eliminado del Carrito',
                'cantidad' => 77,
                /*'id' => "favoritos_id_producto",
                'clase' => "favoritos_id_producto",*/
            ];
        }
        return response()->json($json);
    }

}
