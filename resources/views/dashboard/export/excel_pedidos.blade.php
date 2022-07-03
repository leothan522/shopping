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
        <td colspan="2">Reporte:&nbsp;</td>
        <td colspan="3">
            <strong>{{ $estatus }}</strong>
        </td>
        @if($inicio || $final)
            <td colspan="2">Filtrar Fecha:&nbsp;</td>
            <td>Inicio:&nbsp;</td>
            <td>
                <strong>{{ \Carbon\Carbon::parse($inicio)->format('d-m-Y') }}</strong>
            </td>
            <td>Final:&nbsp;</td>
            <td colspan="2">
                <strong>{{ \Carbon\Carbon::parse($final)->format('d-m-Y') }}</strong>
            </td>
        @endif
        @if($metodo)
        <td colspan="1">
            Metodo Pago:
        </td>
        <td><strong>{{ $metodo }}</strong></td>
        @endif
        @if($delivery)
        <td colspan="1">
            Delivery:
        </td>
        <td><strong>{{ $delivery }}</strong></td>
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
        <th style="border: 1px solid #000000; text-align: left">ID</th>
        <th style="border: 1px solid #000000; text-align: left">Numero</th>
        <th style="border: 1px solid #000000; text-align: left">Cedula Cliente</th>
        <th style="border: 1px solid #000000; text-align: left">Nombre Cliente</th>
        <th style="border: 1px solid #000000; text-align: left">Telefono Cliente</th>
        <th style="border: 1px solid #000000; text-align: center">Delivery</th>
        <th style="border: 1px solid #000000; text-align: center">Total $</th>
        <th style="border: 1px solid #000000; text-align: center">Taza Dolar</th>
        <th style="border: 1px solid #000000; text-align: center">Total Bs.</th>
        <th style="border: 1px solid #000000; text-align: left">Metodo Pago</th>
        <th style="border: 1px solid #000000; text-align: left">Comprobante</th>
        <th style="border: 1px solid #000000; text-align: center">Fecha</th>
        <th style="border: 1px solid #000000; text-align: left">Estatus</th>
        <th style="border: 1px solid #000000; text-align: left">Zona para el envio</th>
        <th style="border: 1px solid #000000; text-align: left">Mensajero</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listarPedidos as $pedido)
        <tr>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->id }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->numero }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ strtoupper($pedido->cedula) }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ strtoupper($pedido->nombre) }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ strtoupper($pedido->telefono) }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->label_delivery }}</td>
            <td style="border: 1px solid #000000; text-align: right">{{ $pedido->total }}</td>
            <td style="border: 1px solid #000000; text-align: right">{{ $pedido->precio_dolar }}</td>
            <td style="border: 1px solid #000000; text-align: right">{{ $pedido->bs }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->label_metodo }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->comprobante_pago }}</td>
            <td style="border: 1px solid #000000; text-align: center">{{ $pedido->label_fecha }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->label_estatus  }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->label_zona }}</td>
            <td style="border: 1px solid #000000; text-align: left">{{ $pedido->mensajero }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
