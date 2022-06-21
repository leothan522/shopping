<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Almacen</h3>

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
                Ver Almacenes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'almacen.index')"
                           @if(leerJson($roles_permisos, 'almacen.index')) checked @endif
                           class="custom-control-input" id="customSwitchRolesalmacen0">
                    <label class="custom-control-label" for="customSwitchRolesalmacen0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Almacenes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'almacen.create')"
                           @if(leerJson($roles_permisos, 'almacen.create')) checked @endif
                           class="custom-control-input" id="customSwitchRolesalmacen1">
                    <label class="custom-control-label" for="customSwitchRolesalmacen1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Almacenes
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'almacen.destroy')"
                           @if(leerJson($roles_permisos, 'almacen.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchRolesalmacen3">
                    <label class="custom-control-label" for="customSwitchRolesalmacen3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] almacen
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'almacen.excel')"
                           @if(leerJson($roles_permisos, 'almacen.excel')) checked @endif
                           class="custom-control-input" id="customSwitchRolesalmacen4">
                    <label class="custom-control-label" for="customSwitchRolesalmacen4"></label>
                </div>
            </li>--}}
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
