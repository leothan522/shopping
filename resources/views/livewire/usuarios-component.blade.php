<div>
    {{-- Do your work, then step back. --}}
    <div class="row justify-content-center">

        @if(leerJson(Auth::user()->permisos, 'usuarios.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
            @include('dashboard.usuarios.create')
        @endif

        <div class="col-md-9">

            <div class="card card-outline card-purple"
                 style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">
                        @if($busqueda)
                            Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                        @else
                            Usuarios Registrados
                        @endif
                    </h3>
                    <div class="card-tools">

                        @if($busqueda)

                            <a href="{{ route('usuarios.index') }}"
                               class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                                <i class="fas fa-list"></i> Ver Todos
                            </a>

                            @if(leerJson(Auth::user()->permisos, 'usuarios.excel') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <a href="{{ route('usuarios.excel', $busqueda) }}"
                                   class="btn btn-tool text-success swalDefaultInfo" {{--target="_blank"--}}>
                                    <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                                </a>
                            @else
                                <a href="{{ route('usuarios.excel') }}"
                                   class="btn btn-tool text-success swalDefaultInfo disabled" {{--target="_blank"--}}>
                                    <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                                </a>
                            @endif

                        @else

                            @if(leerJson(Auth::user()->permisos, 'usuarios.excel') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <a href="{{ route('usuarios.excel') }}"
                                   class="btn btn-tool text-success swalDefaultInfo" {{--target="_blank"--}}>
                                    <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('usuarios.pdf') }}"
                                   class="btn btn-tool text-danger swalDefaultInfo" target="_blank">
                                    <i class="fas fa-file-pdf"></i> <i class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                            @else
                                <a href="{{ route('usuarios.excel') }}"
                                   class="btn btn-tool text-success swalDefaultInfo disabled" {{--target="_blank"--}}>
                                    <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                                </a>
                                <a href="{{ route('usuarios.pdf') }}"
                                   class="btn btn-tool text-danger swalDefaultInfo disabled" target="_blank">
                                    <i class="fas fa-file-pdf"></i> <i class="fas fa-arrow-alt-circle-right"></i>
                                </a>
                            @endif
                        @endif

                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                    @include('dashboard.usuarios.table')

                    @include('dashboard.usuarios.modal_edit')

                    @include('dashboard.usuarios.modal_permisos')


                </div>
                <!-- /.card-body -->
            </div>

            <div class="row justify-content-end p-3">
                <div class="col-md-3">
                    <span>
                    {{ $users->render() }}
                    </span>
                </div>
            </div>

        </div>
    </div>


</div>
