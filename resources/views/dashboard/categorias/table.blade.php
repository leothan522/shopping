<table class="table table-hover bg-light mt-3 table-responsive">
    <thead class="thead-dark">
    <tr>
        <th scope="col" class="text-center"><i class="fas fa-image"></i></th>
        <th scope="col">Nombre</th>
        <th scope="col" class="text-center">Modulo</th>
        <th scope="col" class="text-center">Cantidad</th>
        <th scope="col" style="width: 5%;">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @if(!$categorias->isEmpty())
    @foreach ($categorias as $categoria)
        <tr>
            <td class="text-center">
                <div class="product-img">
                    <img src="{{ asset(verImg($categoria->miniatura)) }}" alt="Producto Imagen" class="img-size-50">
                </div>
            </td>
            <td>
                {{ ucwords($categoria->nombre) }}<br>
                <span class="text-muted text-sm">
                    <i class="fa fa-globe text-primary"></i>
                    ID: {{ $categoria->id }}</span>
            </td>
            <td class="text-center">
                {{ verTipoCategoria($categoria->tipo) }}
            </td>
            <td class="text-center">
                {{ formatoMillares($categoria->num_productos, 0) }}
            </td>
            <td class="text-center">
                <div class="btn-group">
                    @if(leerJson(Auth::user()->permisos, 'categorias.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <button type="button" wire:click="edit({{ $categoria->id }})" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-info disabled btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endif
                    @if(leerJson(Auth::user()->permisos, 'categorias.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        @if($categoria->num_productos == 0)
                            <button type="button" wire:click="destroy({{ $categoria->id }})" class="btn btn-info btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-info disabled btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-info disabled btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    @else
        <tr class="text-center">
            <td colspan="4">
                <a href="{{ route('categorias.index') }}">
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
        {{ $categorias->render() }}
        </span>
    </div>
</div>

