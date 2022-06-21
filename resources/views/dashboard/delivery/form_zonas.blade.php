<form @if($view_zonas == 'create') wire:submit.prevent="storeZonas" @else wire:submit.prevent="updateZonas({{ $zona_id }})" @endif>


    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="zona" placeholder="Zona Delivery">
            @error('zona')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="name">Precio Delivery</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
            </div>
            <input type="number" step=".01" class="form-control" wire:model.defer="precio" placeholder="Precio">
            @error('precio')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>


    <div class="form-group text-center">
        @if($zona_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiarZonas()" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Zona">
        @endif
    </div>



</form>
