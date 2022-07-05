<form @if($view == 'create') wire:submit.prevent="store" @else wire:submit.prevent="update({{ $producto_id }})" @endif>

    <div class="card card-outline card-purple">
        <div class="card-header">
            <h5 class="card-title">Imagen</h5>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-image"></i></span>
            </div>
        </div>
        <div class="card-body">


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

            @if ($photo)

                Preview:

                <img src="{{ $photo->temporaryUrl() }}" class="img-fluid img-thumbnail rounded mx-auto d-block">
            @else

            <img src="{{ asset(verImg($imagen)) }}" class="img-fluid img-thumbnail rounded mx-auto d-block">

            @endif

            <div wire:loading wire:target="photo">Uploading...</div>

        </div>
    </div>

    <div class="card card-outline card-purple">
        <div class="card-header">
            <h5 class="card-title">Información Requerida</h5>
            <div class="card-tools">
                <span class="btn btn-tool"><i class="fas fa-book"></i></span>
            </div>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-box"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="nombre" placeholder="Nombre del Producto">
                    @error('nombre')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="email">Categoria</label>
                <div class="input-group mb-3" wire:ignore>
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                        {!! Form::select('categoria', $listarCategorias, null, ['id' => 'item_categoria_select', 'class' => 'custom-select select2bs4', 'wire:model' => 'categoria' , 'placeholder' => 'Seleccione']); !!}
                </div>
                @error('categoria')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>



        </div>
    </div>

    <div class="card card-outline card-purple collapsed-card">
        <div class="card-header">
            <h5 class="card-title">Información Adicional <span class="text-muted">(Opcional)</span></h5>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="display: none;">

            <div class="form-group">
                <label for="name">Descripción:</label>
                <div class="input-group mb-3">
                    <textarea class="form-control" cols="1" rows="1" wire:model.defer="descripcion" placeholder="Descripción corta del Producto"></textarea>
                    @error('descripcion')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Sku</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="sku" placeholder="Codigo del Producto">
                    @error('sku')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Marca</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fab fa-medium-m"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="marca" placeholder="marca">
                    @error('marca')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Modelo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="modelo" placeholder="modelo">
                    @error('modelo')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Referencia</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="referencia" placeholder="referencia">
                    @error('referencia')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Unidad</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-underline"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model.defer="unidad" placeholder="unidad">
                    @error('unidad')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Existencias</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                    </div>
                    <select class="custom-select" wire:model.defer="decimales">
                        <option value="0">Entero</option>
                        <option value="1">Decimales</option>
                    </select>
                    @error('decimales')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Impuesto</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-coins"></i></span>
                    </div>
                    <select class="custom-select" wire:model.defer="impuesto">
                        <option value="1">I.V.A. ({{ calcularIVA(null, null, null, true) }}%)</option>
                        <option value="0">Excento</option>
                    </select>
                    @error('impuesto')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Venta Individual</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-cube"></i></span>
                    </div>
                    <select class="custom-select" wire:model.defer="individual">
                        <option value="0">NO APLICA</option>
                        <option value="1">Vendido individualmente</option>
                    </select>
                    @error('individual')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>


        </div>
        <!-- /.card-body -->
    </div>


    <div class="form-group text-center">
        @if($producto_id)
            <input type="submit" class="btn btn-primary mr-3" value="Guardar Cambios">
            <input type="button" wire:click="limpiar()" class="btn btn-default" value="Cancelar">
        @else
            <input type="submit" class="btn btn-block btn-success" value="Crear Producto">
        @endif
    </div>

</form>
