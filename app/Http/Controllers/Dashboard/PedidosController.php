<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\PedidosExport;
use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\Delivery;
use App\Models\Parametro;
use App\Models\Pedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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

    public $arrayMetodos = array();

    public function createExcel(Request $request)
    {
        $verEstatus = [
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
        $label_delivery = $request->reporte_delivery;

        if ($estatus == "all"){
            $buscarEstatus = [1,2,3];
        }else{
            $buscarEstatus = [$estatus];
        }

        if (!is_null($metodo)){
            $parametros = Parametro::where('nombre', 'metodo_pago')
                ->where('valor', $metodo)
                ->get();
        }else{
            $parametros = Parametro::where('nombre', 'metodo_pago')->get();
        }

        $parametros->each(function ($parametro){
            array_push($this->arrayMetodos, $parametro->id);
        });
        $diaCero ="2022-01-01";
        $hoy = date('Y-m-d');
        if (!$inicio) { $inicio = $diaCero; }
        if (!$final) { $final = $hoy; }
        if ($inicio > $hoy){ $inicio = $hoy; }
        if ($final > $hoy){ $final = $hoy; }
        if ($inicio > $final) { $inicio = $final; }

        if ($delivery){
            if ($delivery == "SI"){ $delivery = "> 0"; }else{ $delivery = "= 0"; }
        }else{
            $delivery = ">= 0";
        }

        $listarPedidos = Pedido::orderBy('id', 'ASC')
            ->whereIn('estatus', $buscarEstatus)
            ->whereIn('metodo_pago', $this->arrayMetodos)
            ->whereBetween('fecha', [$inicio, $final])
            ->whereRaw("delivery $delivery")
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
            $pedido->label_estatus = $verEstatus[$pedido->estatus];

            $delivery = Delivery::where('pedidos_id', $pedido->id)->first();
            if ($delivery){
                $pedido->label_delivery = "SI";
                $pedido->label_zona = $delivery->nombre;
                if ($delivery->mensajeros_id){
                    $pedido->mensajero = $delivery->mensajero->nombre;
                }else{
                    $pedido->mensajero = "";
                }
            }else{
                $pedido->label_delivery = "NO";
                $pedido->label_zona = "";
                $pedido->mensajero = "";
            }
            $carbon = new Carbon();
            $format = "d-m-Y";
            $pedido->label_fecha = $carbon->parse($pedido->fecha)->format($format);

        });

        return Excel::download(new PedidosExport($verEstatus[$estatus], $inicio, $final, $metodo, $label_delivery, $listarPedidos), 'Pedidos.xlsx');
    }


}
