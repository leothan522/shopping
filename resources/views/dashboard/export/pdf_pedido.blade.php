<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ViewPDF | </title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <img src="{{ asset('img/logo_shopping.png') }}" style="width: 100px;" />
                        </td>

                        <td>
                            Pedido #: <strong style="font-weight: bold;color: red;">{{ $pedido->numero }}</strong><br />
                            Fecha: {{ fecha($pedido->fecha) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            @if($delivery)
                            Zona para el envio:<br />
                            <span style="color: red;">{{ $delivery->nombre }}</span><br />
                            @endif
                            Dirección:<br />
                             {{ $pedido->direccion_1 }}<br />
                             {{ $pedido->direccion_2 }}
                        </td>

                        <td>
                            Cedula: {{ $pedido->cedula }}<br />
                            Nombre: {{ $pedido->nombre }}<br />
                            Teléfono: {{ $pedido->telefono }}<br /><br>
                            <small><small><small>Usuario ID: {{ $pedido->users_id }}</small></small></small>
                            <small><small><small>[{{ $pedido->user->email }}]</small></small></small>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Metodo de Pago</td>

            <td>Comprobante</td>
        </tr>

        <tr class="details">
            <td>{{ $pedido->label_metodo }}</td>

            <td>
                @if(empty($pedido->comprobante_pago))
                    ----
                    @else
                    {{ $pedido->comprobante_pago }}
                @endif
            </td>
        </tr>

        <tr class="heading">
            <td>Productos</td>

            <td>Total</td>
        </tr>

        @foreach($listarCarrito as $carrito)
            <tr class="item">
            <td>
                {{ $carrito->stock->producto->nombre }} (x{{ formatoMillares($carrito->cantidad, 0) }})&nbsp;&nbsp;&nbsp;
                <small><small>[ Tienda: {{ $carrito->stock->empresa->nombre }} / Stock ID: {{ $carrito->stock_id }} ]</small></small>
            </td>
            <td>${{ formatoMillares($carrito->total) }}</td>
        </tr>
        @endforeach

        <tr class="total">
            <td></td>
            <td style="background: #eee; border-bottom: 1px solid #ddd;"><small><small style="float: left;">Subtotal:</small></small> ${{ formatoMillares($pedido->subtotal) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td style="background: #eee; border-bottom: 1px solid #ddd;"><small><small style="float: left;">I.V.A.(16%):</small></small> ${{ formatoMillares($pedido->iva) }}</td>
        </tr>
        @if($pedido->delivery > 0)
        <tr class="total">
            <td></td>
            <td style="background: #eee; border-bottom: 1px solid #ddd;"><small><small style="float: left;">Delivery:</small></small> ${{ formatoMillares($pedido->delivery) }}</td>
        </tr>
        @endif
        <tr class="total">
            <td></td>
            <td style="background: #eee; border-bottom: 1px solid #ddd; font-weight: bold;color: red;"><span style="float: left;">Total:</span> ${{ formatoMillares($pedido->total) }}</td>
        </tr>
        <tr class="total">
            <td><small><small><small><small>Precio Dolar Usado: {{ formatoMillares($pedido->precio_dolar) }} Bs.</small></small></small></small></td>
            <td style="background: #eee; border-bottom: 1px solid #ddd;"><small><small style="float: left;">Bs:</small></small> {{ formatoMillares($pedido->bs) }} Bs.</td>
        </tr>
    </table>
</div>
</body>
</html>
