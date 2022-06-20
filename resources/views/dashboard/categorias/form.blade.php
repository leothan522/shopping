<form @if($view == 'create') wire:submit.prevent="store" @else wire:submit.prevent="update({{ $categoria_id }})" @endif>

    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tag"></i></span>
            </div>
            <input type="text" wire:model.defer="nombre" class="form-control" placeholder="Nombre de la Categoria">
            @error('nombre')
            <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label>Imagen</label>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" wire:model="photo" class="custom-file-input" id="customFileLang" lang="es" accept="image/jpeg, image/png">
                <label class="custom-file-label" for="customFileLang" data-browse="Elegir">Seleccionar Archivo</label>
            </div>
            @error('photo')
            <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <div wire:loading wire:target="photo">Uploading...</div>
        @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
        @else
            @if($imagen)
                <img src="{{ asset(verImg($imagen)) }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
                @else
                <img src="{{ asset(verImg(null)) }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
            @endif

        @endif

    </div>



    <div class="form-group text-center">
        @if($view == 'create')
            <input type="submit" class="btn btn-block btn-success" value="Guardar">
            @else
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar()" class="btn btn-default" value="Cancelar">
        @endif

    </div>

</form>
