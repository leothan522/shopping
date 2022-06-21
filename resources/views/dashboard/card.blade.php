<div class="card card-gray-dark" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header">
        <h3 class="card-title">
            @if(/*$view == 'create'*/true)
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

    {{--@include('dashboard.productos.form')--}}

    <!-- /.card-body -->
    </div>
    <div class="overlay-wrapper" wire:loading>
        <div class="overlay">
            <i class="fas fa-2x fa-sync-alt"></i>
        </div>
    </div>

</div>

<div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
    <div class="card-header">
        <h3 class="card-title">

            @if(/*$busqueda*/true)
                Resultados de la Busqueda { <b class="text-danger">{{--{{ $busqueda }}--}} </b>}
            @else
                Productos Registrados
            @endif

        </h3>
        <div class="card-tools">
            @if(/*$busqueda*/true)
                <a href="{{ route('productos.index') }}"
                   class="btn btn-tool btn-outline-primary text-danger" {{--target="_blank"--}}>
                    <i class="fas fa-list"></i> Ver Todos
                </a>
            @endif
            @if(leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                <button type="button" class="btn btn-tool" {{--wire:click="limpiar"--}}>
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

        @if(/*$count*/false)
            {{--@include('dashboard.productos.table')
            @include('dashboard.productos.show')--}}
        @else
            Debes crear un nuevo Producto.
        @endif
    </div>
    <!-- /.card-body -->
</div>
