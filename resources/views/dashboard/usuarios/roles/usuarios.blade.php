<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Usuarios</h3>

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
                Ver Usuarios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.index')"
                           @if(leerJson($roles_permisos, 'usuarios.index')) checked @endif
                           class="custom-control-input" id="customSwitchRoles0">
                    <label class="custom-control-label" for="customSwitchRoles0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Usuarios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.create')"
                           @if(leerJson($roles_permisos, 'usuarios.create')) checked @endif
                           class="custom-control-input" id="customSwitchRoles1">
                    <label class="custom-control-label" for="customSwitchRoles1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Usuarios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.edit')"
                           @if(leerJson($roles_permisos, 'usuarios.edit')) checked @endif
                           class="custom-control-input" id="customSwitchRoles2">
                    <label class="custom-control-label" for="customSwitchRoles2"></label>
                </div>
            </li>
            <li class="list-group-item">
                Reestablecer Contraseña
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.update')"
                           @if(leerJson($roles_permisos, 'usuarios.update')) checked @endif
                           class="custom-control-input" id="customSwitchRoles3">
                    <label class="custom-control-label" for="customSwitchRoles3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                Permisos de Usuario
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.permisos')"
                           @if(leerJson($roles_permisos, 'usuarios.permisos')) checked @endif
                           class="custom-control-input" id="customSwitchRoles4">
                    <label class="custom-control-label" for="customSwitchRoles4"></label>
                </div>
            </li>
            <li class="list-group-item">
                Roles de Usuarios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.roles')"
                           @if(leerJson($roles_permisos, 'usuarios.roles')) checked @endif
                           class="custom-control-input" id="customSwitchRoles8">
                    <label class="custom-control-label" for="customSwitchRoles8"></label>
                </div>
            </li>--}}
            <li class="list-group-item">
                Descargar Excel
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.excel')"
                           @if(leerJson($roles_permisos, 'usuarios.excel')) checked @endif
                           class="custom-control-input" id="customSwitchRoles5">
                    <label class="custom-control-label" for="customSwitchRoles5"></label>
                </div>
            </li>
            <li class="list-group-item">
                Descargar PDF
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.pdf')"
                           @if(leerJson($roles_permisos, 'usuarios.pdf')) checked @endif
                           class="custom-control-input" id="customSwitchRoles7">
                    <label class="custom-control-label" for="customSwitchRoles7"></label>
                </div>
            </li>
            <li class="list-group-item">
                Eliminar Usuarios
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'usuarios.destroy')"
                           @if(leerJson($roles_permisos, 'usuarios.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchRoles6">
                    <label class="custom-control-label" for="customSwitchRoles6"></label>
                </div>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
