<div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header">
        <h3 class="card-title">
            @if(leerJson(Auth::user()->permisos, 'metodos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                <div class="custom-control custom-switch custom-switch-on-success">
                    <input type="checkbox" wire:click="parametro('movil')"
                           @if($movil) checked @endif
                    class="custom-control-input" id="customSwitchMovil">
                    <label class="custom-control-label" for="customSwitchMovil">Pago Movil</label>
                </div>
                @else
                <div class="custom-control custom-switch custom-switch-on-success">
                    <input type="checkbox" disabled
                           @if($movil) checked @endif
                           class="custom-control-input" id="customSwitchMovil">
                    <label class="custom-control-label" for="customSwitchMovil">Pago Movil</label>
                </div>
            @endif


        </h3>
        <div class="card-tools">
            {{--@if($busqueda)
                <a href="{{ route('almacen.index') }}"
                   class="btn btn-tool btn-outline-primary text-danger" --}}{{--target="_blank"--}}{{-->
                    <i class="fas fa-list"></i> Ver Todos
                </a>
            @endif--}}
            @if(leerJson(Auth::user()->permisos, 'cuentas.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-lg-movil" wire:click="limpiar">
                    <i class="fas fa-plus-square"></i>
                </button>
            @endif

            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        @if($count_mov)
            @include('dashboard.metodos.table_movil')
        @else
            Debes crear un nuevo Pago Movil.
        @endif
        @include('dashboard.metodos.modal_movil')
    </div>
    <!-- /.card-body -->
</div>
