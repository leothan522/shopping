<div class="row justify-content-center">

    @if(leerJson(Auth::user()->permisos, 'categorias.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
    <div class="col-md-4">

        <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">
                    @if($view == 'create')
                        Crear Categoria
                        @else
                        Editar Categoria
                    @endif
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" wire:click="limpiar">
                        <i class="fas fa-tags"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            @include('dashboard.categorias.form')

            <!-- /.card-body -->
            </div>
            <div class="overlay-wrapper" wire:loading>
                <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
            </div>

        </div>

    </div>
    @endif
    <div class="col-md-8">

        <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
            <div class="card-header">
                <h3 class="card-title">

                    @if($busqueda)
                        Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}
                    @else
                        Categorias Registradas
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('categorias.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                            <i class="fas fa-list"></i> Ver Todas
                        </a>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'categorias.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                    <button type="button" class="btn btn-tool" wire:click="limpiar">
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

                @if($cont)
                    @include('dashboard.categorias.table')
                    @else
                    Debes crear una nueva Categoria.
                @endif
            </div>
            <!-- /.card-body -->
        </div>

    </div>


</div>
