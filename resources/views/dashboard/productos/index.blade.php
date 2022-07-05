<div class="row justify-content-center">

    @if(leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
        <div class="col-md-4">

            <div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
                <div class="card-header">
                    <h3 class="card-title">
                        @if($view == 'create')
                            Crear Producto
                        @else
                            Editar Producto
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" wire:click="limpiar">
                            <i class="fas fa-box"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                @include('dashboard.productos.form')

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
                        Productos Registrados
                    @endif

                </h3>
                <div class="card-tools">
                    @if($busqueda)
                        <a href="{{ route('productos.index') }}"
                           class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                            <i class="fas fa-list"></i> Ver Todos
                        </a>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
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

                @if($count)
                    @include('dashboard.productos.table')
                    @include('dashboard.productos.show')
                @else
                    Debes crear un nuevo Producto.
                @endif
            </div>
            <!-- /.card-body -->
        </div>


    </div>

</div>

<script>
    document.addEventListener('livewire:load', function () {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('.select2bs4').on('change', function () {
            @this.set('categoria', this.value);
        });
        Livewire.on('cambiarSelect', selectItem => {
            $(".select2bs4").select2();
        });
    });


</script>
