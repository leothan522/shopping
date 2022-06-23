<!-- Table row -->
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 2%;">#</th>
                <th>Producto</th>
                <th>Almacen</th>
                <th class="text-right" style="width: 10%;">PVP</th>
                <th class="text-right" style="width: 10%;">I.V.A. {{ calcularIVA(null, null, null, true) }}%</th>
                <th class="text-right" style="width: 10%">Precio</th>
                <th class="text-center" style="width: 10%;">Stock</th>
                <th class="text-center" style="width: 10%;">Estatus</th>
                <th style="width: 5%;"></th>
            </tr>
            </thead>
            <tbody>
            @if(!$listarStock->isEmpty())
            @php($i = 0)
            @foreach($listarStock as $stock)
                @php($i++)
                <tr>
                    <td class="text-muted text-sm">{{ $i }}</td>
                    <td>{{ $stock->producto->nombre }}</td>
                    <td>{{ $stock->almacen->nombre }}</td>
                    <td class="text-right">{{ $stock->moneda }} {{ formatoMillares($stock->pvp) }}</td>
                    <td class="text-right">
                        @if($stock->producto->impuesto == 1)
                            {{ $stock->moneda }} {{ calcularIVA($stock->productos_id, $stock->pvp, true) }}
                            @else
                            <span>Exento</span>
                        @endif
                    </td>
                    <td class="text-right">{{ $stock->moneda }} {{ calcularIVA($stock->productos_id, $stock->pvp) }}</td>
                    <td class="text-right">
                        @if($stock->producto->decimales) @php($dec = 2) @else @php($dec = 0) @endif
                            <i class="fas fa-boxes float-left"></i>
                            {{ formatoMillares($stock->stock_disponible, $dec) }}
                    </td>
                    <td class="text-center">
                        @if($stock->estatus)
                            <i class="fas fa-globe text-success"></i>
                            @else
                            <i class="fas fa-eraser text-muted"></i>
                        @endif
                            <span class="text-sm"> ID: {{ $stock->id }}</span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" wire:click="show({{ $stock->id }})"
                                    data-toggle="modal" data-target="#modal-lg-show" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if(leerJson(Auth::user()->permisos, 'stock.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <button type="button" wire:click="edit({{ $stock->id }})"
                                        data-toggle="modal" data-target="#modal-lg-stock" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-info btn-sm disabled">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            @if(leerJson(Auth::user()->permisos, 'stock.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <button type="button" wire:click="destroy({{ $stock->id }})" class="btn btn-info btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-info btn-sm disabled">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            @else
                <tr class="text-center">
                    @if($busqueda)
                        <td colspan="9">
                            <a href="{{ route('stock.index') }}">
                            <span>
                                Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                            </span>
                            </a>
                        </td>
                        @else
                        <td colspan="9">
                            <span>Debes agregar un nuevo Stock</span>
                        </td>
                    @endif
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div class="row justify-content-end p-3">
    <div class="col-md-3">
        <span>
        {{ $listarStock->render() }}
        </span>
    </div>
</div>
