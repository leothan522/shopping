<li class="nav-item">
    @if(leerJson(Auth::user()->permisos, 'precio.dolar')|| Auth::user()->role == 1 || Auth::user()->role == 100)
        <button class="nav-link btn" wire:click="edit('{{ $edit }}')">
            <i class="fas fa-dollar-sign"></i> Precio Dolar
        </button>
        @else
        <span class="nav-link">
            <i class="fas fa-dollar-sign"></i> Precio Dolar
        </span>
    @endif
</li>
@if(!$edit)
    <li class="nav-item text-center">
        <span class="text-small text-muted text-bold">{{ formatoMillares($dollar) }} Bs.</span>
    </li>
    @else
    <li class="nav-item text-center">
        <form wire:submit.prevent="store">
            {{--<div wire:loading>
                <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt"></i>
                </div>
            </div>--}}
            <div class="input-group input-group-sm">
                <input type="number" step=".01" class="form-control" required wire:model.defer="dollar">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fas fa-save"></i>
                    </button>
                  </span>
            </div>
        </form>
    </li>
@endif

