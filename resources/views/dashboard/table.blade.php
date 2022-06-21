<div class="table-responsive">
    <table class="table table-hover bg-light">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Zonas</th>
            <th scope="col" class="text-right">Precio</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        {{--@if(!$productos->isEmpty())
        @foreach($listarZonas as $zona)
            <tr>
                <td>{{ $zona->nombre }}</td>
                <td class="text-right">{{ $zona->precio }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach--}}
        {{--@else
        <tr class="text-center">
            <td colspan="4">
                <a href="{{ route('delivery.index') }}">
                            <span>
                                Sin resultados para la busqueda <strong class="text-bold"> { <span class="text-danger">--}}{{--{{ $busqueda }}--}}{{--</span> }</strong>
                            </span>
                </a>
            </td>
        </tr>--}}
        {{-- @endif--}}
        </tbody>
    </table>
</div>
