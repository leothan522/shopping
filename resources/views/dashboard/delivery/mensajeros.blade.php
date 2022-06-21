<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 3%;">#</th>
            <th scope="col">C.I.</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col" class="text-center">Telefono</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @if(!$listarMensajeros->isEmpty())
        @php($i = 0)
        @foreach($listarMensajeros as $mensajero)
            @php($i++)
            <tr>
                <td class="text-muted">{{ $i }}</td>
                <td>{{ $mensajero->cedula }}</td>
                <td>{{ $mensajero->nombre }}</td>
                <td class="text-right">{{ $mensajero->telefono }}</td>
                <td>
                    <div class="btn-group">
                        @if(leerJson(Auth::user()->permisos, 'mensajeros.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" class="btn btn-info btn-sm" wire:click="editMensajeros({{ $mensajero->id }})"
                                    data-toggle="modal" data-target="#modal-lg-mensajeros">
                                <i class="fas fa-edit"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-info btn-sm disabled">
                                <i class="fas fa-edit"></i>
                            </button>
                        @endif
                        @if(leerJson(Auth::user()->permisos, 'mensajeros.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" class="btn btn-info btn-sm" wire:click="destroyMensajeros({{ $mensajero->id }})">
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
                <td colspan="5">
                    <a href="{{ route('delivery.index') }}">
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
