{{--
<button wire:click="edit({{ $user->id }})" data-toggle="modal" data-target="#modal-lg" class="btn btn-info btn-sm">
    <i class="fas fa-edit"></i>
</button>
--}}

{{--<div class="overlay-wrapper" wire:loading>
    <div class="overlay">
        <i class="fas fa-2x fa-sync-alt"></i>
    </div>
</div>--}}

<div wire:ignore.self class="modal fade" id="modal-lg-ver-pedido">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fondo">
            <div class="modal-header">
                <h4 class="modal-title">Ver Pedido</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div wire:loading>
                    <div class="overlay">
                        <i class="fas fa-2x fa-sync-alt"></i>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-7">

                        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                            <div class="card-header">
                                <h3 class="card-title">
                                   Detalles del Pedido
                                </h3>
                                <div class="card-tools">
                                    <span class="btn btn-tool">
                                        <i class="fas fa-shopping-bag"></i>
                                    </span>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="col-lg-12 col-md-6">
                                    <div class="">
                                        <h4>Pedido <span class="float-right text-bold">{{ $numero }}</span></h4>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item list-group-item-dark" aria-current="true">
                                                Productos <span class="float-right">Total</span>
                                            </li>
                                            @foreach($listarCarrito as $carrito)
                                            <li class="list-group-item list-group-item-light" aria-current="true">
                                                {{ $carrito->stock->producto->nombre }}
                                                <small>(x{{ formatoMillares($carrito->cantidad, 0) }})</small>
                                                <span class="float-right">${{ formatoMillares($carrito->total) }}</span>
                                            </li>
                                            @endforeach

                                            <li class="list-group-item list-group-item-secondary text-bold">
                                                Subtotal
                                                <span class="float-right">${{ $subtotal }}</span>
                                            </li>
                                            <li class="list-group-item list-group-item-secondary text-bold">
                                                I.V.A.(16%)
                                                <span class="float-right">${{ $iva }}</span>
                                            </li>
                                            @if($delivery > 0)
                                                <li class="list-group-item list-group-item-secondary text-bold">
                                                    Delivery
                                                    <span class="float-right">${{ $delivery }}</span>
                                                </li>
                                            @endif
                                            <li class="list-group-item list-group-item-secondary text-bold">
                                                Total
                                                <span class="float-right text-danger">${{ $total }}</span>
                                            </li>
                                            <li class="list-group-item list-group-item-secondary text-bold">
                                                Bs.
                                                <span class="float-right">{{ $bs }} Bs.</span>
                                            </li>
                                        </ul>

                                    </div>
                                </div>

                            <!-- /.card-body -->
                            </div>
                            <div class="overlay-wrapper" wire:loading>
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt"></i>
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="col-md-5">

                        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Datos de Facturación
                                </h3>
                                <div class="card-tools">
                                    <span class="btn btn-tool">
                                        <i class="fas fa-file-invoice"></i>
                                    </span>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="col-lg-12 col-md-6">
                                    <div class="col-sm-12 invoice-col">
                                        <span><b>Fecha:</b> <span class="float-right">{{ fecha($fecha) }}</span></span><br>
                                        <span><b>Cedula:</b> <span class="float-right">{{ $cedula }}</span></span><br>
                                        <span><b>Nombre:</b> <span class="float-right">{{ $nombre }}</span></span><br>
                                        <span><b>telefono:</b> <span class="float-right">{{ $telefono }}</span></span><br>
                                        <p><b>Direccion:</b><br> {{ $direccion_1 }} <br> {{ $direccion_2 }}</p>
                                        <span><b>Metodo Pago:</b> <span class="float-right">{{ $label_metodo }}</span></span><br>
                                        @if($comprobante_pago)
                                            <span><b>Comprobante Pago:</b> <span class="float-right text-bold text-primary">{{ $comprobante_pago }}</span></span><br>
                                        @endif
                                        <span><b>Precio Dolar:</b> <span class="float-right">{{ formatoMillares($precio_dolar, 2) }} Bs.</span></span><br>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </div>
                            <div class="overlay-wrapper" wire:loading>
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt"></i>
                                </div>
                            </div>

                        </div>


                                    @if($estatus == 0)
                                        <span class="float-right text-warning">
                                                <i class="fas fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                                                </span>
                                    @endif
                                    @if($estatus == 1)
                                        <div class="alert alert-warning">
                                            <h5><i class="fas fa-money-check-alt"></i> Verificando Pago!</h5>
                                            Pedido en espera de la verificacion del pago.
                                        </div>
                                    @endif
                                    @if($estatus == 2)
                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fas fa-shipping-fast"></i> Pedido en ruta!</h5>
                                            Pedido en proceso de despacho.
                                        </div>
                                    @endif
                                    @if($estatus == 3)
                                        <div class="alert alert-success">
                                            <h5><i class="fas fa-check-circle"></i> Pedido Entregado!</h5>
                                            Pedido procesado completamente.
                                        </div>
                                    @endif


                    </div>

                </div>




            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
