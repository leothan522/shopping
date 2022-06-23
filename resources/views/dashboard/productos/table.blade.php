<table class="table table-hover bg-light mt-3 table-responsive">
    <thead class="thead-dark">
    <tr>
        <th scope="col" class="text-center"><i class="fas fa-image"></i></th>
        <th scope="col">Nombre</th>
        <th scope="col" class="text-center">Categoría</th>
        <th scope="col" class="text-center">Impuesto</th>
        <th scope="col" class="text-center">Venta Individual</th>
        <th scope="col" style="width: 5%;"></th>
    </tr>
    </thead>
    <tbody>
    @if(!$productos->isEmpty())
    @foreach ($productos as $producto)
        <tr>
            <td class="text-center">
                <div class="product-img">
                    <img src="{{ asset(verImg($producto->miniatura)) }}" alt="Producto Imagen" class="img-size-50">
                </div>
            </td>
            <td>
                {{ ucwords($producto->nombre) }}<br>
                <span class="text-muted text-sm">
                @if ($producto->estatus == 0)
                    <i class="fa fa-eraser"></i>
                @else
                    <i class="fa fa-globe text-primary"></i>
                @endif
                ID: {{ $producto->id }}</span>
            </td>
            <td class="text-center">{{ $producto->categoria->nombre }}</td>
            <td class="text-center">
                @if($producto->impuesto)
                    <span class="text-sm text-info">I.V.A. {{ calcularIVA(null, null, null, true) }}%</span>
                    @else
                    <span class="text-sm text-muted">Exento</span>
                @endif
            </td>
            <td class="text-center">
                @if($producto->individual)
                    <span class="text-sm">Vendido <br>Individualmente</span>
                    @else
                    <span class="text-sm text-muted">NO APLICA</span>
                @endif
            </td>
            <td class="text-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm" wire:click="show({{ $producto->id }})"
                            data-toggle="modal" data-target="#modal-lg-producto">
                        <i class="fas fa-eye"></i>
                    </button>
                    @if(leerJson(Auth::user()->permisos, 'productos.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-info btn-sm" wire:click="edit({{ $producto->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                        @else
                        <button type="button" class="btn btn-info btn-sm disabled">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'productos.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" class="btn btn-info btn-sm" wire:click="destroy({{ $producto->id }})">
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
            <td colspan="6">
                <a href="{{ route('productos.index') }}">
                    <span>
                        Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                    </span>
                </a>
            </td>
        </tr>
    @endif
    </tbody>
</table>

<div class="row justify-content-end p-3">
    <div class="col-md-3">
        <span>
        {{ $productos->render() }}
        </span>
    </div>
</div>
