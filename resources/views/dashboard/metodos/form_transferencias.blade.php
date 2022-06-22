<form @if($view == 'create') wire:submit.prevent="storeTran" @else wire:submit.prevent="updateTran({{ $transferencia_id }})" @endif>


    <div class="form-group">
        <label for="name">Banco</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-university"></i></span>
            </div>
            <input type="text" class="form-control" wire:model.defer="banco" placeholder="Nombre del banco">
            @error('banco')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="name">Tipo Cuenta</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="tipo" placeholder="Tipo">
                @error('tipo')
                <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="name">Numero Cuenta</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="numero" placeholder="Numero">
                @error('numero')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="name">Titular</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="titular" placeholder="Titular">
                @error('titular')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="name">RIF</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
                <input type="text" class="form-control" wire:model.defer="rif" placeholder="RIF">
                @error('rif')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>

    </div>

    <div class="form-group text-center">
        @if($transferencia_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Cuenta">
        @endif
    </div>



</form>
