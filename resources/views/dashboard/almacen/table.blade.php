<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 2%;">#</th>
            <th scope="col">Almacenes</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @if(!$almacenes->isEmpty())
            @php($i = 0)
            @foreach($almacenes as $almacen)
                @php($i++)
                <tr>
                    <td class="text-muted">{{ $i }}</td>
                    <td>{{ $almacen->nombre }}</td>
                    <td>
                        <div class="btn-group">
                            @if(leerJson(Auth::user()->permisos, 'almacen.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <button type="button" class="btn btn-info btn-sm" wire:click="edit({{ $almacen->id }})"
                                        data-toggle="modal" data-target="#modal-lg-almacen">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @else
                                <button type="button" class="btn btn-info btn-sm disabled">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                            @if(leerJson(Auth::user()->permisos, 'almacen.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                                <button type="button" class="btn btn-info btn-sm" wire:click="destroy({{ $almacen->id }})">
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
                <td colspan="3">
                    <a href="{{ route('almacen.index') }}">
                        <span>
                            Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                        </span>
                    </a>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>
