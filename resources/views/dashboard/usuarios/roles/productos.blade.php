<div class="card card-gray-dark {{--collapsed-card--}}">
    <div class="card-header">
        <h3 class="card-title">Productos</h3>

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
                Ver Productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'productos.index')"
                           @if(leerJson($roles_permisos, 'productos.index')) checked @endif
                           class="custom-control-input" id="customSwitchRolesproductos0">
                    <label class="custom-control-label" for="customSwitchRolesproductos0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'productos.create')"
                           @if(leerJson($roles_permisos, 'productos.create')) checked @endif
                           class="custom-control-input" id="customSwitchRolesproductos1">
                    <label class="custom-control-label" for="customSwitchRolesproductos1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'productos.destroy')"
                           @if(leerJson($roles_permisos, 'productos.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchRolesproductos3">
                    <label class="custom-control-label" for="customSwitchRolesproductos3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_roles({{ $rol_id }}, 'productos.excel')"
                           @if(leerJson($roles_permisos, 'productos.excel')) checked @endif
                           class="custom-control-input" id="customSwitchRolesproductos4">
                    <label class="custom-control-label" for="customSwitchRolesproductos4"></label>
                </div>
            </li>--}}
        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
