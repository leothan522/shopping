<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Cedula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Dirección</th>
            <th scope="col" class="text-center" style="width: 10%;">User ID</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @if(!$listarClientes->isEmpty())
        @foreach($listarClientes as $cliente)
            <tr>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>
                    <span class="text-sm">{{ $cliente->direccion_1 }}</span>
                </td>
                <td class="text-center">
                    <i class="fas fa-user"></i>
                    <span class="text-sm"> ID: {{ $cliente->users_id }}</span>
                </td>
                <td>
                    @if(leerJson(Auth::user()->permisos, 'clientes.excel') || Auth::user()->role == 1 || Auth::user()->role == 100)
                        <form action="{{ route('clientes.excel') }}" method="post" class="swalDefaultInfo">
                            @csrf
                            <input type="hidden" name="cedula" value="{{ $cliente->cedula }}">
                            <input type="hidden" name="users_id" value="{{ $cliente->users_id }}">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fas fa-shopping-bag"></i>
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm disabled">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </div>
                    @endif
                </td>
            </tr>
        @endforeach
        @else
            @if($busqueda)
                <tr class="text-center">
                    <td colspan="6">
                        <a href="{{ route('clientes.index') }}">
                    <span>
                        Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{ $busqueda }}</span> }</strong>
                    </span>
                        </a>
                    </td>
                </tr>
                @else
                <tr class="text-center">
                    <td colspan="6">
                        Aun no se han registrado Clientes.
                    </td>
                </tr>
            @endif
        @endif
        </tbody>
    </table>
</div>

<div class="row justify-content-end p-3">
    <div class="col-md-3">
        <span>
        {{ $listarClientes->render() }}
        </span>
    </div>
</div>
