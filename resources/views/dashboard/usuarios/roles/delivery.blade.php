<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Delivery</h3>

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
                Ver Delivery
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'delivery.index')"
                           @if(leerJson($roles_permisos, 'delivery.index')) checked @endif
                           class="custom-control-input" id="customSwitchDeliveryDeliRo0">
                    <label class="custom-control-label" for="customSwitchDeliveryDeliRo0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Ver Zonas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'zonas.show')"
                           @if(leerJson($roles_permisos, 'zonas.show')) checked @endif
                           class="custom-control-input" id="customSwitchDeliveryZonasRo0">
                    <label class="custom-control-label" for="customSwitchDeliveryZonasRo0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Zonas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'zonas.create')"
                           @if(leerJson($roles_permisos, 'zonas.create')) checked @endif
                           class="custom-control-input" id="customSwitchDeliveryZonasRo1">
                    <label class="custom-control-label" for="customSwitchDeliveryZonasRo1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Zonas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'zonas.destroy')"
                           @if(leerJson($roles_permisos, 'zonas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchDeliveryZonasRo3">
                    <label class="custom-control-label" for="customSwitchDeliveryZonasRo3"></label>
                </div>
            </li>
            <li class="list-group-item">
                Ver Mensajeros
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'mensajeros.show')"
                           @if(leerJson($roles_permisos, 'mensajeros.show')) checked @endif
                           class="custom-control-input" id="customSwitchDeliverymensajerosRo0">
                    <label class="custom-control-label" for="customSwitchDeliverymensajerosRo0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Mensajeros
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'mensajeros.create')"
                           @if(leerJson($roles_permisos, 'mensajeros.create')) checked @endif
                           class="custom-control-input" id="customSwitchDeliverymensajerosRo1">
                    <label class="custom-control-label" for="customSwitchDeliverymensajerosRo1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Mensajeros
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'mensajeros.destroy')"
                           @if(leerJson($roles_permisos, 'mensajeros.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchDeliverymensajerosRo3">
                    <label class="custom-control-label" for="customSwitchDeliverymensajerosRo3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'productos.excel')"
                           @if(leerJson($roles_permisos, 'productos.excel')) checked @endif
                           class="custom-control-input" id="customSwitchDeliverymensajerosRo4">
                    <label class="custom-control-label" for="customSwitchDeliverymensajerosRoZonas4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
