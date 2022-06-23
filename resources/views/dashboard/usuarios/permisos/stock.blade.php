<div class="card card-gray-dark collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Stock</h3>

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
                Ver Stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.index')"
                           @if(leerJson($user_permisos, 'stock.index')) checked @endif
                           class="custom-control-input" id="customSwitchstock0">
                    <label class="custom-control-label" for="customSwitchstock0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.create')"
                           @if(leerJson($user_permisos, 'stock.create')) checked @endif
                           class="custom-control-input" id="customSwitchstock1">
                    <label class="custom-control-label" for="customSwitchstock1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.destroy')"
                           @if(leerJson($user_permisos, 'stock.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchstock3">
                    <label class="custom-control-label" for="customSwitchstock3"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Entrada|Salida] Stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.ajustes')"
                           @if(leerJson($user_permisos, 'stock.ajustes')) checked @endif
                           class="custom-control-input" id="customSwitchstockAs3">
                    <label class="custom-control-label" for="customSwitchstockAs3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] stock
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'stock.excel')"
                           @if(leerJson($user_permisos, 'stock.excel')) checked @endif
                           class="custom-control-input" id="customSwitchstock4">
                    <label class="custom-control-label" for="customSwitchstock4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
