<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Empresas</h3>

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
                Ver Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'empresas.index')"
                           @if(leerJson($roles_permisos, 'empresas.index')) checked @endif
                           class="custom-control-input" id="customSwitchRolesEmp0">
                    <label class="custom-control-label" for="customSwitchRolesEmp0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'empresas.create')"
                           @if(leerJson($roles_permisos, 'empresas.create')) checked @endif
                           class="custom-control-input" id="customSwitchRolesEmp1">
                    <label class="custom-control-label" for="customSwitchRolesEmp1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'empresas.edit')"
                           @if(leerJson($roles_permisos, 'empresas.edit')) checked @endif
                           class="custom-control-input" id="customSwitchRolesEmp2">
                    <label class="custom-control-label" for="customSwitchRolesEmp2"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'empresas.destroy')"
                           @if(leerJson($roles_permisos, 'empresas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchRolesEmp3">
                    <label class="custom-control-label" for="customSwitchRolesEmp3"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
