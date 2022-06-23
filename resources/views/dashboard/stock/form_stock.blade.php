<form @if($view == 'create') wire:submit.prevent="store" @else wire:submit.prevent="update({{ $stock_id }})" @endif>

    <div class="form-group">
        <label for="email">Producto</label>
        <div class="input-group mb-3" wire:ignore>
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-box"></i></span>
            </div>
            {!! Form::select('productos', $listarProductos, null, ['class' => 'custom-select select2bs4', 'wire:model.defer' => 'producto' , 'placeholder' => 'Seleccione']); !!}
        </div>
        @error('producto')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Almacen</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-warehouse"></i></span>
            </div>
            {!! Form::select('productos', $listarAlmacen, null, ['class' => 'custom-select', 'wire:model.defer' => 'almacen_id' , 'placeholder' => 'Seleccione']); !!}
        </div>
        @error('almacen_id')
        <span class="col-sm-12 text-sm text-bold text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Moneda</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
            </div>
            <select class="custom-select" wire:model="moneda">
                <option value="Bs.">Bolivares</option>
                <option value="$">Dolares</option>
            </select>
            @error('moneda')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="name">PVP</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text text-bold">{{ $moneda }}</span>
            </div>
            <input type="number" step=".01" min="0.01" class="form-control" wire:model.defer="pvp" placeholder="Precio sin IVA">
            @error('pvp')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="email">Estatus</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-globe"></i></span>
            </div>
            <select class="custom-select" wire:model.defer="estatus">
                <option value="0">Borrador</option>
                <option value="1">Publicado</option>
            </select>
            @error('estatus')
            <span class="col-sm-12 text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                {{ $message }}
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group text-center">
        @if($stock_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Guardar Stock">
        @endif
    </div>



</form>
