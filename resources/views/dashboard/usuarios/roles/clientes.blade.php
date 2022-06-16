<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Clientes</h3>

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
                Ver Clientes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'clientes.index')"
                           @if(leerJson($roles_permisos, 'clientes.index')) checked @endif
                           class="custom-control-input" id="customSwitchRolesClien0">
                    <label class="custom-control-label" for="customSwitchRolesClien0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Clientes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'clientes.create')"
                           @if(leerJson($roles_permisos, 'clientes.create')) checked @endif
                           class="custom-control-input" id="customSwitchRolesClien1">
                    <label class="custom-control-label" for="customSwitchRolesClien1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Clientes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'clientes.destroy')"
                           @if(leerJson($roles_permisos, 'clientes.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchRolesClien3">
                    <label class="custom-control-label" for="customSwitchRolesClien3"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Exportar|Excel] Clientes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'clientes.excel')"
                           @if(leerJson($roles_permisos, 'clientes.excel')) checked @endif
                           class="custom-control-input" id="customSwitchRolesClien4">
                    <label class="custom-control-label" for="customSwitchRolesClien4"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
