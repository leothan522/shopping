
<form @if($viewMov == 'create') wire:submit.prevent="storeMov" @else wire:submit.prevent="updateMov({{ $movil_id }})" @endif>


    <div class="form-group">
        <label for="name">Codigo Banco</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-university"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="codigo" placeholder="Codigo">
            @error('codigo')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Telefono</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="telefono" placeholder="Telefono">
                @error('telefono')
                <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="name">Cedula</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="cedula" placeholder="cedula">
                @error('cedula')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-group text-center">
        @if($movil_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Parametro">
        @endif
    </div>



</form>
