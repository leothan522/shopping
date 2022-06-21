<div class="card card-gray-dark collapsed-card">
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
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'productos.index')"
                           @if(leerJson($user_permisos, 'productos.index')) checked @endif
                           class="custom-control-input" id="customSwitchproductos0">
                    <label class="custom-control-label" for="customSwitchproductos0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'productos.create')"
                           @if(leerJson($user_permisos, 'productos.create')) checked @endif
                           class="custom-control-input" id="customSwitchproductos1">
                    <label class="custom-control-label" for="customSwitchproductos1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'productos.destroy')"
                           @if(leerJson($user_permisos, 'productos.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchproductos3">
                    <label class="custom-control-label" for="customSwitchproductos3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] productos
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'productos.excel')"
                           @if(leerJson($user_permisos, 'productos.excel')) checked @endif
                           class="custom-control-input" id="customSwitchproductos4">
                    <label class="custom-control-label" for="customSwitchproductos4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
