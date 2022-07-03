<?php

namespace App\Exports;

use App\Models\Pedido;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PedidosExport implements FromView, ShouldAutoSize
{
    public function __construct($estatus, $inicio, $final, $metodo, $delivery, $pedidos)
    {
        $this->estatus = $estatus;
        $this->inicio = $inicio;
        $this->final = $final;
        $this->metodo = $metodo;
        $this->delivery = $delivery;
        $this->pedidos = $pedidos;
    }

    public function view(): View
    {
        // TODO: Implement view() method.
        return view('dashboard.export.excel_pedidos')
            ->with('estatus', $this->estatus)
            ->with('inicio', $this->inicio)
            ->with('final', $this->final)
            ->with('metodo', $this->metodo)
            ->with('delivery', $this->delivery)
            ->with('listarPedidos', $this->pedidos)
            ;
    }
}
