<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Metodos de Pago</h3>

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
                Ver Metodos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'metodos.index')"
                           @if(leerJson($roles_permisos, 'metodos.index')) checked @endif
                           class="custom-control-input" id="customSwitchmetodosRol0">
                    <label class="custom-control-label" for="customSwitchmetodosRol0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Gestionar Metodos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'metodos.create')"
                           @if(leerJson($roles_permisos, 'metodos.create')) checked @endif
                           class="custom-control-input" id="customSwitchmetodosRol1">
                    <label class="custom-control-label" for="customSwitchmetodosRol1"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Cuentas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'cuentas.create')"
                           @if(leerJson($roles_permisos, 'cuentas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchmetodosRol3">
                    <label class="custom-control-label" for="customSwitchmetodosRol3"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Cuentas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'cuentas.destroy')"
                           @if(leerJson($roles_permisos, 'cuentas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchmetodosRol5">
                    <label class="custom-control-label" for="customSwitchmetodosRol5"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] almacen
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'almacen.excel')"
                           @if(leerJson($roles_permisos, 'almacen.excel')) checked @endif
                           class="custom-control-input" id="customSwitchmetodosRol4">
                    <label class="custom-control-label" for="customSwitchmetodosRol4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
