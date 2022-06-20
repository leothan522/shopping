<ul class="list-group text-sm">
    @if(!$empresas->isEmpty())
        @foreach($empresas as $empresa)
            <li class="list-group-item fondo">
                <button type="button" class="btn btn-xs btn-link @if($empresa_id == $empresa->id) text-muted @endif" wire:click="show({{ $empresa->id }})" >
                    {!! empresaDefault($empresa->default) !!} {{ $empresa->nombre }}
                </button>
                @if(leerJson(Auth::user()->permisos, 'empresas.estatus') || Auth::user()->role == 1 || Auth::user()->role == 100)
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success float-right">
                        <input type="checkbox" @if(estatusTienda($empresa->id, true)) checked @endif wire:click="estatusTienda({{ $empresa->id }})" class="custom-control-input" id="customSwitchIdL{{ $empresa->id }}">
                        <label class="custom-control-label" for="customSwitchIdL{{ $empresa->id }}"></label>
                    </div>
                    @else
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success float-right">
                        <input type="checkbox" @if(estatusTienda($empresa->id, true)) checked @endif class="custom-control-input" disabled="" id="customSwitchIdL{{ $empresa->id }}">
                        <label class="custom-control-label" for="customSwitchIdL{{ $empresa->id }}"></label>
                    </div>
                @endif
            </li>
        @endforeach
        @else
        Debes crear una nueva Empresa.
    @endif
</ul>

