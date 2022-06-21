<div class="row justify-content-center">
    <div class="col-md-4">


        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">

                    @if($busqueda)
                        Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                    @else
                        Almacenes Registrados
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('almacen.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                            <i class="fas fa-list"></i> Ver Todos
                        </a>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'almacen.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-lg-almacen" wire:click="limpiar">
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

                @if($count)
                    @include('dashboard.almacen.table')
                @else
                    Debes crear un nuevo Almacen.
                @endif
                @include('dashboard.almacen.modal')
            </div>
            <!-- /.card-body -->
        </div>



    </div>
</div>
