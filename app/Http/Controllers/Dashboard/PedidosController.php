<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PedidosExport;
use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Parametro;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function createExcel(Request $request)
    {
        $verMetodos = [
            '1' => 'Pedidos en espera de la verificacion del pago',
            '2' => 'Pedidos en proceso de despacho',
            '3' => 'Pedidos procesados completamente',
            'all' => 'Todos'
        ];
        $estatus = $request->reporte_estatus;
        $inicio = $request->reporte_inicio;
        $final = $request->reporte_final;
        $metodo = $request->reporte_metodo;
        $delivery = $request->reporte_delivery;

        $listarPedidos = Pedido::orderBy('id', 'ASC')
            ->get();

        $listarPedidos->each(function ($pedido){
            $verEstatus = [
                '1' => 'Pedidos en espera de la verificacion del pago',
                '2' => 'Pedidos en proceso de despacho',
                '3' => 'Pedidos procesados completamente',
                'all' => 'Todos'
            ];
            $parametro = Parametro::find($pedido->metodo_pago);
            $valor = $parametro->valor;
            if ($valor == "movil"){
                $valor = "PAGO MOVIL";
            }
            $metodo = str_replace('_', ' ', $valor);
            $pedido->label_metodo = strtoupper($metodo);
        });

        return Excel::download(new PedidosExport($verMetodos[$estatus], $inicio, $final, $metodo, $delivery, $listarPedidos), 'Pedidos.xlsx');
    }


}
