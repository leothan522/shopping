<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="text-center">Nº Pedido</th>
                <th>Cedula Cliente</th>
                <th>Nombre Cliente</th>
                <th>Telefono Cliente</th>
                <th class="text-center" style="width: 5%;">Delivery</th>
                <th class="text-center" style="width: 5%;">Items</th>
                <th class="text-right" style="width: 10%;"><i class="fa fa-dollar-sign"></i>Total</th>
                <th class="text-left" style="width: 10%;">Metodo Pago</th>
                <th class="text-center" style="width: 10%;">Fecha</th>
                <th class="text-center" style="width: 10%;">Estatus</th>
                <th style="width: 5%;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($listarPedidos as $pedido)
                <tr>
                    <td class="text-center text-bold">{{ $pedido->numero }}</td>
                    <td>{{ $pedido->cedula }}</td>
                    <td>{{ $pedido->nombre }}</td>
                    <td>{{ $pedido->telefono }}</td>
                    <td class="text-center">
                        @if($pedido->delivery > 0)
                            <i class="fas fa-truck text-danger"></i>
                            @else
                            <i class="fas fa-store-alt text-muted"></i>
                        @endif
                    </td>
                    <td class="text-center">{{ formatoMillares($pedido->items, 0)  }}</td>
                    <td class="text-right">${{ formatoMillares($pedido->total)  }}</td>
                    <td class="text-left"><small class="">{{ $pedido->metodo }}</small></td>
                    <td class="text-center">{{ fecha($pedido->fecha) }}</td>
                    <td class="text-center">{!! verIconoEstatusPedico($pedido->estatus) !!}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" wire:click="verPedido({{ $pedido->id }})"
                                    data-toggle="modal" data-target="#modal-lg-ver-pedido" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button type="button" {{--wire:click="show({{ $stock->id }})"--}}
                            data-toggle="modal" {{--data-target="#modal-lg-show"--}} class="btn btn-info btn-sm">
                                <i class="fas fa-print"></i>
                            </button>

                            {{--<button type="button" class="btn btn-info btn-sm disabled">
                                <i class="fas fa-trash-alt"></i>
                            </button>--}}
                        </div>
                    </td>
                </tr>
            @endforeach
                {{--<tr class="text-center">--}}
                   {{-- @if($busqueda)
                        <td colspan="9">
                            <a href="{{ route('stock.index') }}">
                            <span>
                                Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                            </span>
                            </a>
                        </td>
                        @else
                        <td colspan="9">
                            <span>Debes agregar un nuevo Stock</span>
                        </td>
                    @endif--}}
                {{--</tr>--}}
            {{--@endif--}}
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row justify-content-end p-3">
    <div class="col-md-3">
        <span>
        {{ $listarPedidos->render() }}
        </span>
    </div>
</div>
