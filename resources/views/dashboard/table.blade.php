<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col">C.I./Pasaporte </th>
            <th scope="col">Nombre Completo</th>
            <th scope="col" class="text-center">Sexo</th>
            <th scope="col" class="text-center">País</th>
            <th scope="col" class="text-center">Edad</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        {{--@if(!$listaAtletas->isEmpty())
            @foreach($listaAtletas as $atleta)
                <th scope="row" class="text-center">{{ $atleta->id }}</th>
                <td>{{ $atleta->cedula }}</td>
                <td>{{ strtoupper($atleta->primer_nombre." ".$atleta->segundo_nombre." ".$atleta->primer_apellido." ".$atleta->segundo_apellido) }}</td>
                <td class="text-center">{{ $atleta->sexo }}</td>
                <td class="text-center">{{ paises($atleta->pais) }}</td>
                <td class="text-center">{{ calcularEdad($atleta->fecha_nac) }}</td>
                <td class="justify-content-end">
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg-datos-atletas" wire:click="verPlanilla({{ $atleta->id }})">
                            <i class="fas fa-id-card"></i>
                        </button>

                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg-foto" wire:click="verFoto({{ $atleta->id }})">
                            <i class="fas fa-image"></i>
                        </button>
                </div>
                </td>
                </tr>
            @endforeach
        @else--}}
            <tr class="text-center">
                <td colspan="7">
                    <a href="{{ route('administracion.atletas') }}">
                            <span>
                                Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">{{--{{ $busqueda }}--}}</span> }</strong>
                            </span>
                    </a>
                </td>
            </tr>
       {{-- @endif--}}
        </tbody>
    </table>
</div>
