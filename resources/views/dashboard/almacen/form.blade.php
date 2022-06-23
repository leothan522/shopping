<form @if($view == 'create') wire:submit.prevent="store" @else wire:submit.prevent="update({{ $almacen_id }})" @endif>


    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="nombre" placeholder="Nombre del almacen">
            @error('nombre')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group text-center">
        @if($almacen_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Almacen">
        @endif
    </div>



</form>
