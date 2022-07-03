<?php

namespace App\Exports;

use App\Models\Pedido;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PedidosExport implements FromView, ShouldAutoSize, WithStyles, WithColumnFormatting
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

    public function styles(Worksheet $sheet)
    {
        // TODO: Implement styles() method.
        return [
            '5' => [
                'font' => ['bold' => true],
                'fill' => ['fillType'   => Fill::FILL_SOLID, 'startColor' => ['argb' => Color::COLOR_CYAN]],
            ],
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

}
