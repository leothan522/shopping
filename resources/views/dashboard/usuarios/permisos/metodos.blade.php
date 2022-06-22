<div class="card card-gray-dark collapsed-card">
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
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'metodos.index')"
                           @if(leerJson($user_permisos, 'metodos.index')) checked @endif
                           class="custom-control-input" id="customSwitchmetodos0">
                    <label class="custom-control-label" for="customSwitchmetodos0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Gestionar Metodos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'metodos.create')"
                           @if(leerJson($user_permisos, 'metodos.create')) checked @endif
                           class="custom-control-input" id="customSwitchmetodos1">
                    <label class="custom-control-label" for="customSwitchmetodos1"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Cuentas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'cuentas.create')"
                           @if(leerJson($user_permisos, 'cuentas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchmetodos3">
                    <label class="custom-control-label" for="customSwitchmetodos3"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Cuentas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'cuentas.destroy')"
                           @if(leerJson($user_permisos, 'cuentas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchmetodos5">
                    <label class="custom-control-label" for="customSwitchmetodos5"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] almacen
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'almacen.excel')"
                           @if(leerJson($user_permisos, 'almacen.excel')) checked @endif
                           class="custom-control-input" id="customSwitchmetodos4">
                    <label class="custom-control-label" for="customSwitchmetodos4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
