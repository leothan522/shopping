<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Parametro;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        return view('dashboard.pedidos.pedidos');
    }

    public function createPDF($id)
    {
        $pedido = Pedido::findOrFail($id);
        $carrito = Carrito::where('pedidos_id', $pedido->id)->get();
        $delivery = Delivery::where('pedidos_id', $pedido->id)->first();
        $parametro = Parametro::find($pedido->metodo_pago);
        $valor = $parametro->valor;
        if ($valor == "movil"){
            $valor = "PAGO MOVIL";
        }
        $metodo = str_replace('_', ' ', $valor);
        $pedido->label_metodo = strtoupper($metodo);

        $data = [
            'pedido'        => $pedido,
            'listarCarrito' => $carrito,
            'delivery'      => $delivery
        ];

        $pdf = Pdf::loadView('dashboard.export.pdf_pedido', $data);
        return $pdf->download("Pedido_$pedido->numero.pdf");
    }


}
