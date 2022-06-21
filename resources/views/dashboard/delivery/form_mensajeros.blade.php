<form @if($view_mensajeros == 'create') wire:submit.prevent="storeMensajeros" @else wire:submit.prevent="updateMensajeros({{ $mensajero_id }})" @endif>


    <div class="form-group">
        <label for="name">C.I./Pasaporte</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="cedula" placeholder="C.I./Pasaporte">
            @error('cedula')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="mensajero" placeholder="Nombre y Apellido">
            @error('mensajero')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="name">Telefono</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="telefono" placeholder="Telefono Celular">
            @error('telefono')
            <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
            @enderror
        </div>
    </div>




    <div class="form-group text-center">
        @if($mensajero_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiarMensajeros" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Mensajero">
        @endif
    </div>



</form>
