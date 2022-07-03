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

<div wire:ignore.self class="modal fade" id="modal-lg-reportes-excel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content fondo">
            <div class="modal-header">
                <h4 class="modal-title">Generar Reportes</h4>
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

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Pedidos
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" {{--wire:click="limpiar"--}}>
                                        <i class="fas fa-shopping-bag"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <form action="{{ route('pedidos.excel') }}" method="post" id="swalDefaultInfo">
                                    @csrf

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{--<i class="fas fa-warehouse"></i>--}}
                                                    Reporte
                                                </span>
                                            </div>
                                            <select name="reporte_estatus" class="custom-select" required>
                                                <option value="">Seleccione</option>
                                                <option value="1">Pedidos en espera de la verificacion del pago</option>
                                                <option value="2">Pedidos en proceso de despacho</option>
                                                <option value="3">Pedidos procesados completamente</option>
                                                <option value="all">Todos</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Filtrar Fecha:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{--<i class="fas fa-warehouse"></i>--}}
                                                    Inicio
                                                </span>
                                                    </div>
                                                    <input type="date" name="reporte_inicio" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{--<i class="fas fa-warehouse"></i>--}}
                                                    Final
                                                </span>
                                                    </div>
                                                    <input type="date" name="reporte_final" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{--<i class="fas fa-warehouse"></i>--}}
                                                    Metodo
                                                </span>
                                                    </div>
                                                    <select name="reporte_metodo" class="custom-select">
                                                        <option value="">Todos</option>
                                                        <option value="efectivo_bs">Efectivo BS</option>
                                                        <option value="efectivo_dolares">Efectivo Dolares</option>
                                                        <option value="debito">Tarjeta de Debito</option>
                                                        <option value="transferencia">Transferencias</option>
                                                        <option value="movil">Pago Movil</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    {{--<i class="fas fa-warehouse"></i>--}}
                                                    Delivery
                                                </span>
                                                    </div>
                                                    <select name="reporte_delivery" class="custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="SI">SI</option>
                                                        <option value="NO">NO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <input type="submit" class="btn btn-block btn-success swalDefaultInfo" value="Generar Reporte">
                                    </div>

                                </form>

                            <!-- /.card-body -->
                            </div>
                            {{--<div class="overlay-wrapper" wire:loading>
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt"></i>
                                </div>
                            </div>--}}

                        </div>

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
