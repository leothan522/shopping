<div class="card card-gray-dark {{--collapsed-card--}}">
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
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'pedidos.index')"
                           @if(leerJson($roles_permisos, 'pedidos.index')) checked @endif
                           class="custom-control-input" id="customSwitchRolesPediose0">
                    <label class="custom-control-label" for="customSwitchRolesPediose0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Validar Pagos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'pedidos.validar_pago')"
                           @if(leerJson($roles_permisos, 'pedidos.validar_pago')) checked @endif
                           class="custom-control-input" id="customSwitchRolesPediose1">
                    <label class="custom-control-label" for="customSwitchRolesPediose1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Procesar Despachos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'pedidos.procedar_despacho')"
                           @if(leerJson($roles_permisos, 'pedidos.procedar_despacho')) checked @endif
                           class="custom-control-input" id="customSwitchRolesPediose3">
                    <label class="custom-control-label" for="customSwitchRolesPediose3"></label>
                </div>
            </li>
            <li class="list-group-item">
                Imprimir Pedidos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'pedidos.imprimir')"
                           @if(leerJson($roles_permisos, 'pedidos.imprimir')) checked @endif
                           class="custom-control-input" id="customSwitchRolesPedioseAs3">
                    <label class="custom-control-label" for="customSwitchRolesPedioseAs3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'stock.excel')"
                           @if(leerJson($roles_permisos, 'stock.excel')) checked @endif
                           class="custom-control-input" id="customSwitchRolesPediose4">
                    <label class="custom-control-label" for="customSwitchRolesPediose4"></label>
                </div>
            </li>--}}
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
