<div class="card card-gray-dark collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Categorias</h3>

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
                Ver Categorias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'categorias.index')"
                           @if(leerJson($user_permisos, 'categorias.index')) checked @endif
                           class="custom-control-input" id="customSwitchCategorias0">
                    <label class="custom-control-label" for="customSwitchCategorias0"></label>
                </div>
            </li>
            <li class="list-group-item">
                [Crear|Editar] Categorias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'categorias.create')"
                           @if(leerJson($user_permisos, 'categorias.create')) checked @endif
                           class="custom-control-input" id="customSwitchCategorias1">
                    <label class="custom-control-label" for="customSwitchCategorias1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar categorias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'categorias.destroy')"
                           @if(leerJson($user_permisos, 'categorias.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchCategorias3">
                    <label class="custom-control-label" for="customSwitchCategorias3"></label>
                </div>
            </li>
            {{--<li class="list-group-item">
                [Exportar|Excel] categorias
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'categorias.excel')"
                           @if(leerJson($user_permisos, 'categorias.excel')) checked @endif
                           class="custom-control-input" id="customSwitchCategorias4">
                    <label class="custom-control-label" for="customSwitchCategorias4"></label>
                </div>
            </li>--}}

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
