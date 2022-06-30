<div class="card card-gray-dark collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Pedidos</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0" wire:ignore.self>

        <ul class="list-group text-sm">
            <li class="list-group-item">
                Ver Pedidos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'pedidos.index')"
                           @if(leerJson($user_permisos, 'pedidos.index')) checked @endif
                           class="custom-control-input" id="customSwitchPediso0">
                    <label class="custom-control-label" for="customSwitchPediso0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Validar Pagos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'pedidos.validar_pago')"
                           @if(leerJson($user_permisos, 'pedidos.validar_pago')) checked @endif
                           class="custom-control-input" id="customSwitchPediso1">
                    <label class="custom-control-label" for="customSwitchPediso1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Procesar Despachos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'pedidos.procedar_despacho')"
                           @if(leerJson($user_permisos, 'pedidos.procedar_despacho')) checked @endif
                           class="custom-control-input" id="customSwitchPediso3">
                    <label class="custom-control-label" for="customSwitchPediso3"></label>
                </div>
            </li>
            <li class="list-group-item">
                Imprimir Pedidos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'pedidos.imprimir')"
                           @if(leerJson($user_permisos, 'pedidos.imprimir')) checked @endif
                           class="custom-control-input" id="customSwitchPedisoAs3">
                    <label class="custom-control-label" for="customSwitchPedisoAs3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.excel')"
                           @if(leerJson($user_permisos, 'stock.excel')) checked @endif
                           class="custom-control-input" id="customSwitchPediso4">
                    <label class="custom-control-label" for="customSwitchPediso4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
