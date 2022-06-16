<ul class="list-group text-sm">
    @if(!$empresas->isEmpty())
        @foreach($empresas as $empresa)
            <li class="list-group-item fondo">
                <button type="button" class="btn btn-xs btn-link" wire:click="show({{ $empresa->id }})" >
                    {!! empresaDefault($empresa->default) !!} {{ $empresa->nombre }}
                </button>
            </li>
        @endforeach
        @else
        Debes crear una nueva Empresa.
    @endif
</ul>

