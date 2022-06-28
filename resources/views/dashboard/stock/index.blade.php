<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="overlay-wrapper" wire:loading>
                <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
            </div>
            @if(!$count_empresas || !$count_almacenes || !$count_productos)
            <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Nota:</h5>
                Para que este Modulo este <span class="text-bold">Activo</span>,
                es Necesario previmente crear una
                <span class="text-bold @if($count_empresas) text-success @else text-danger @endif">Tienda</span>,
                un <span class="text-bold @if($count_almacenes) text-success @else text-danger @endif">Almacen</span> y Tener Al menos
                un <span class="text-bold @if($count_productos) text-success @else text-danger @endif">Producto</span> Registrado.
            </div>


            @else
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row mb-3">
                    <div class="col-12">
                        <h3>
                            <i class="fas fa-store-alt"></i> {{ $empresa_nombre }}
                            @if($multiple)
                                <small class="float-right">
                                    {!! Form::select('listarEmresa', $listarEmpresas, null , ['class' => 'custom-select', 'wire:model' => 'empresas']) !!}
                                </small>
                            @endif
                        </h3>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-12 mb-3">
                        @if(leerJson(Auth::user()->permisos, 'stock.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" class="btn btn-default btn-sm"
                                    wire:click="limpiar" data-toggle="modal" data-target="#modal-lg-stock">
                                <i class="fas fa-plus-circle"></i> Stock
                            </button>
                            @else
                            <button type="button" class="btn btn-default btn-sm disabled">
                                <i class="fas fa-plus-circle"></i> Stock
                            </button>
                        @endif

                        @if($busqueda)
                                <a href="{{ route('stock.index') }}" class="btn btn-default btn-sm">
                                    <i class="fas fa-list"></i> Ver Todos
                                </a>
                                <span class="btn">Resultados de la Busqueda { <b class="text-danger">{{ $busqueda }} </b>}</span>
                        @endif

                        {{-- right--}}
                        @if(leerJson(Auth::user()->permisos, 'stock.ajustes') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" wire:click="verAjuste('Salida')"
                                    data-toggle="modal" data-target="#modal-lg-ajustes"
                                    class="btn btn-default btn-sm float-right" style="margin-right: 5px;">
                                <i class="fas fa-upload"></i> Salida
                            </button>
                            <button type="button" wire:click="verAjuste('Entrada')"
                                    data-toggle="modal" data-target="#modal-lg-ajustes"
                                    class="btn btn-default btn-sm float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Entrada
                            </button>
                            @else
                                <button type="button" class="btn btn-default btn-sm float-right disabled" style="margin-right: 5px;">
                                    <i class="fas fa-upload"></i> Salida
                                </button>
                                <button type="button" class="btn btn-default btn-sm float-right disabled" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Entrada
                                </button>
                        @endif
                        <button type="button" wire:click="actualizar({{ $empresa_id }})"
                                class="btn btn-default btn-sm float-right" style="margin-right: 5px;">
                            <i class="fas fa-sync"></i> Actualizar
                        </button>
                    </div>
                </div>
                <!-- /.row -->
                @include('dashboard.stock.table_stock')
                @include('dashboard.stock.modal_stock')
                @include('dashboard.stock.show')
                @include('dashboard.stock.modal_ajustes')

            </div>
            <!-- /.invoice -->
            @endif
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->


<script>
    document.addEventListener('livewire:load', function () {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#modal-lg-stock")
        });
        $('.select2bs4').on('change', function () {
        @this.set('producto', this.value);
        })
    })
</script>
