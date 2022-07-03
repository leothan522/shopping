<table>
    <thead>
    <tr>
        <td colspan="7" style="text-align: center">
            <strong>Reporte Pedidos</strong>
        </td>
    </tr>
    <tr>
        <td colspan="7">
            Fecha Reporte:&nbsp;{{ date('d-m-Y H:i a') }}
        </td>
    </tr>
    <tr>
        <td>Reporte:&nbsp;</td>
        <td colspan="6">
            <strong>{{ $estatus }}</strong>
        </td>
        @if($inicio || $final)
            <td colspan="2">Filtrar Fecha:&nbsp;</td>
            <td>Inicio:&nbsp;</td>
            <td colspan="2">
                <strong>{{ fecha($inicio) }}</strong>
            </td>
            <td>Final:&nbsp;</td>
            <td colspan="2">
                <strong>{{ fecha($final) }}</strong>
            </td>
        @endif
        @if($metodo)
        <td colspan="2">
            Metodo Pago:
        </td>
        <td>{{ $metodo }}</td>
        @endif
        @if($delivery)
        <td colspan="2">
            Delivery:
        </td>
        <td>{{ $delivery }}</td>
        @endif
    </tr>

    {{--<tr><td colspan="7">Lugar:&nbsp; <strong>{{ $evento->lugar }}</strong></td></tr>
    <tr>
        <td colspan="4">Fecha:&nbsp; <strong>{{ fecha($evento->fecha) }}</strong></td>
        <td colspan="3">Hora:&nbsp; <strong>{{ hora($evento->hora) }}</strong></td>
    </tr>--}}
    <tr>
        <td>&ensp;</td>
    </tr>
    <tr>
        <th style="border: 1px solid #000000; text-align: center">ID</th>
        <th style="border: 1px solid #000000; text-align: center">Numero</th>
        <th style="border: 1px solid #000000; text-align: center">Cedula Cliente</th>
        <th style="border: 1px solid #000000; text-align: center">Nombre Cliente</th>
        <th style="border: 1px solid #000000; text-align: center">Telefono Cliente</th>
        <th style="border: 1px solid #000000; text-align: center">Delivery</th>
        <th style="border: 1px solid #000000; text-align: center">Total $</th>
        <th style="border: 1px solid #000000; text-align: center">Total Bs.</th>
        <th style="border: 1px solid #000000; text-align: center">Metodo Pago</th>
        <th style="border: 1px solid #000000; text-align: center">Comprobante</th>
        <th style="border: 1px solid #000000; text-align: center">Fecha</th>
        <th style="border: 1px solid #000000; text-align: center">Estatus</th>
        <th style="border: 1px solid #000000; text-align: center">Zona para el envio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listarPedidos as $pedido)
        <tr>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->id }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->numero }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pedido->cedula) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pedido->nombre) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ strtoupper($pedido->telefono) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->delivery }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->total }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->bs }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->label_metodo }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->comprobante_pago }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ fecha($pedido->fecha) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->estatus  }}</td>
            <td style="border: 1px solid #000000; text-align: center">zona</td>
        </tr>
    @endforeach
    </tbody>
</table>
