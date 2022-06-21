<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col" style="width: 2%;">#</th>
            <th scope="col">Zonas</th>
            <th scope="col" class="text-right">Precio</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @if(!$listarZonas->isEmpty())
        @php($i = 0)
        @foreach($listarZonas as $zona)
            @php($i++)
            <tr>
                <td class="text-muted">{{ $i }}</td>
                <td>{{ $zona->nombre }}</td>
                <td class="text-right"><i class="fas fa-dollar-sign"></i> {{ $zona->precio }}</td>
                <td>
                    <div class="btn-group">
                        @if(leerJson(Auth::user()->permisos, 'zonas.create') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" class="btn btn-info btn-sm" wire:click="editZonas({{ $zona->id }})"
                                    data-toggle="modal" data-target="#modal-lg-zonas">
                                <i class="fas fa-edit"></i>
                            </button>
                            @else
                            <button type="button" class="btn btn-info btn-sm disabled">
                                <i class="fas fa-edit"></i>
                            </button>
                        @endif
                        @if(leerJson(Auth::user()->permisos, 'zonas.destroy') || Auth::user()->role == 1 || Auth::user()->role == 100)
                            <button type="button" class="btn btn-info btn-sm" wire:click="destroy({{ $zona->id }})">
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
                <td colspan="4">
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
