<div class="card card-gray-dark collapsed-card">
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
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'empresas.index')"
                           @if(leerJson($user_permisos, 'empresas.index')) checked @endif
                           class="custom-control-input" id="customSwitchEmpr0">
                    <label class="custom-control-label" for="customSwitchEmpr0"></label>
                </div>
            </li>
            <li class="list-group-item">
                Crear Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'empresas.create')"
                           @if(leerJson($user_permisos, 'empresas.create')) checked @endif
                           class="custom-control-input" id="customSwitchEmpr1">
                    <label class="custom-control-label" for="customSwitchEmpr1"></label>
                </div>
            </li>
            <li class="list-group-item">
                Editar Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'empresas.edit')"
                           @if(leerJson($user_permisos, 'empresas.edit')) checked @endif
                           class="custom-control-input" id="customSwitchEmpr2">
                    <label class="custom-control-label" for="customSwitchEmpr2"></label>
                </div>
            </li>
            <li class="list-group-item">
                Borrar Empresas
                <div class="custom-control custom-switch custom-switch-on-success float-right">
                    <input type="checkbox" wire:click="update_permisos({{ $user_id }}, 'empresas.destroy')"
                           @if(leerJson($user_permisos, 'empresas.destroy')) checked @endif
                           class="custom-control-input" id="customSwitchEmpr3">
                    <label class="custom-control-label" for="customSwitchEmpr3"></label>
                </div>
            </li>

        </ul>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
