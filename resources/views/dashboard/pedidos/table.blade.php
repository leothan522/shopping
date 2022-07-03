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
            @if(!$listarPedidos->isEmpty())
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
                    <td class="text-left">
                        <small>
                            {{ $pedido->metodo }}
                            @if($pedido->comprobante_pago)
                                <span class="col-md-12 text-bold text-primary">{{ $pedido->comprobante_pago }}</span>
                            @endif
                        </small>
                    </td>
                    <td class="text-center"><small>{{ fecha($pedido->fecha) }}</small></td>
                    <td class="text-center">{!! verIconoEstatusPedico($pedido->estatus) !!}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" wire:click="verPedido({{ $pedido->id }})"
                                    data-toggle="modal" data-target="#modal-lg-ver-pedido" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>

                            @if(leerJson(Auth::user()->permisos, 'pedidos.imprimir') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                {{--<button type="button" --}}{{--wire:click="show({{ $stock->id }})"--}}{{--
                                data-toggle="modal" --}}{{--data-target="#modal-lg-show"--}}{{-- class="btn btn-info btn-sm">
                                    <i class="fas fa-print"></i>
                                </button>--}}
                                <a href="{{ route('pedidos.pdf', $pedido->id) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                @else
                                <button type="button" {{--wire:click="show({{ $stock->id }})"--}}
                                data-toggle="modal" {{--data-target="#modal-lg-show"--}} class="btn btn-info btn-sm disabled">
                                    <i class="fas fa-print"></i>
                                </button>
                            @endif
                            {{--<button type="button" class="btn btn-info btn-sm disabled">
                                <i class="fas fa-trash-alt"></i>
                            </button>--}}
                        </div>
                    </td>
                </tr>
            @endforeach
            @else
                <tr class="text-center">
                    @if($busqueda)
                        <td colspan="11">
                            <a href="{{ route('pedidos.index') }}">
                            <span>
                                Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                            </span>
                            </a>
                        </td>
                        @else
                        <td colspan="11">
                            <span>Aun no se tienen pedidos registrados.</span>
                        </td>
                    @endif
                </tr>
            @endif
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
