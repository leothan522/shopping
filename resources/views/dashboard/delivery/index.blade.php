<div class="row justify-content-center">

    @if(leerJson(Auth::user()->permisos, 'zonas.show') || Auth::user()->role == 1 || Auth::user()->role == 100)
        <div class="col-md-6">


        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">

                    @if($busqueda)
                        Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                    @else
                        Zonas Registradas
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('delivery.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                            <i class="fas fa-list"></i> Ver Todos
                        </a>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'zonas.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-lg-zonas" wire:click="limpiarZonas">
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

                @if($count_zonas)
                    @include('dashboard.delivery.zonas')
                @else
                    Debes crear una nueva Zona.
                @endif
                @include('dashboard.delivery.modal_zonas')
            </div>
            <!-- /.card-body -->
        </div>



    </div>
    @endif

    @if(leerJson(Auth::user()->permisos, 'mensajeros.show') || Auth::user()->role == 1 || Auth::user()->role == 100)
        <div class="col-md-6">


        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">

                    @if($busqueda)
                        Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                    @else
                        Mensajeros Registrados
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('delivery.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                            <i class="fas fa-list"></i> Ver Todos
                        </a>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'mensajeros.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-lg-mensajeros" wire:click="limpiarMensajeros">
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

                @if($count_mensajeros)
                    @include('dashboard.delivery.mensajeros')

                @else
                    Debes crear un nuevo Mensajero.
                @endif
                @include('dashboard.delivery.modal_mensajeros')
            </div>
            <!-- /.card-body -->
        </div>




    </div>
    @endif




</div>
