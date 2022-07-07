<div class="row justify-content-center">
    <div class="col-md-10">

        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">

                    @if($busqueda)
                        Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                    @else
                        Clientes Registrados
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('clientes.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger">
                            <i class="fas fa-list"></i> Ver Todos
                        </a>
                    @endif
                    {{--@if(leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-tool" wire:click="limpiar">
                            <i class="fas fa-plus-square"></i>
                        </button>
                    @endif--}}
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @include('dashboard.clientes.table')

            </div>
            <!-- /.card-body -->
        </div>

    </div>
</div>
